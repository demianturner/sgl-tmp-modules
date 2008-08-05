<?php

/**
 * Media data access object.
 *
 * @package media2
 * @author Thomas Goetz
 * @author Demian Turner <demian@phpkitchen.com>
 * @author Dmitri Lakachauskis <lakiboy83@gmail.com>
 */
class Media2DAO extends SGL_Manager
{
    /**
     * Returns a singleton Media2DAO instance.
     *
     * @return Media2DAO
     */
    public static function &singleton()
    {
        static $instance;

        // If the instance is not there, create one
        if (!isset($instance)) {
            $class = __CLASS__;
            $instance = new $class();
        }
        return $instance;
    }

    /*
    public function getMimeTypeIdByName($typeName)
    {
        $query = "
            SELECT   media_type_id
            FROM     media_type
            WHERE    name = " . $this->dbh->quoteSmart($typeName) . "
        ";
        return $this->dbh->getOne($query);
    }
    */

    public function getMimeTypes()
    {
        $query = "
            SELECT content_type, idents
            FROM   media_mime
        ";
        return $this->dbh->getAssoc($query);
    }

    public function getMimeTypesByMediaTypeId($typeId)
    {
        $query = "
            SELECT mm.content_type, mm.idents
            FROM   media_mime AS mm, `media_type-mime` mtm
            WHERE  mm.media_mime_id = mtm.media_mime_id
                   AND mtm.media_type_id = " . intval($typeId) . "
        ";
        return $this->dbh->getAssoc($query);
    }

    public function getExtensionByMimeType($mimeType)
    {
        $query = "
            SELECT extension
            FROM   media_mime
            WHERE  content_type = " . $this->dbh->quoteSmart($mimeType) . "
        ";
        return $this->dbh->getOne($query);
    }

    public function getMediaTypeById($typeId)
    {
        $query = "
            SELECT name
            FROM   media_type
            WHERE  media_type_id = " . intval($typeId) . "
        ";
        return $this->dbh->getOne($query);
    }

    public function getMediaById($mediaId)
    {
        $query = "
            SELECT *
            FROM   media
            WHERE  media_id = " . intval($mediaId) . "
        ";
        return $this->dbh->getRow($query);
    }

    public function addMedia($aFields)
    {
        $aFields['media_id']     = $this->dbh->nextId('media');
        $aFields['date_created'] = SGL_Date::getTime($gmt = true);
        $aFields['last_updated'] = $aFields['date_created'];

        $ok = $this->dbh->autoExecute('media', $aFields, DB_AUTOQUERY_INSERT);
        if (PEAR::isError($ok)) {
            $ret = $ok;
        } else {
            $ret = $aFields['media_id'];
        }
        return $ret;
    }

    public function updateMediaById($mediaId, $aFields)
    {
        $aFields['last_updated'] = SGL_Date::getTime($gmt = true);
        $where = 'media_id = ' . intval($mediaId);
        $ok = $this->dbh->autoExecute('media', $aFields,
            DB_AUTOQUERY_UPDATE, $where);
        return $ok;
    }

    public function deleteMediaById($mediaId)
    {
        $query = "
            DELETE FROM media WHERE media_id = " . intval($mediaId) . "
        ";
        $ok = $this->dbh->query($query);
        return $ok;
    }

    public function getMaxMediaOrderByFkId($fkId)
    {
        $query = "
            SELECT MAX(item_order)
            FROM   media
            WHERE  fk_id = " . intval($fkId) . "
        ";
        return $this->dbh->getOne($query);
    }

    public function linkMediaToFk($mediaId, $fkId, $typeId = null)
    {
        $itemOrder = $this->getMaxMediaOrderByFkId($fkId);
        $aFields   = array(
            'fk_id'      => $fkId,
            'item_order' => $itemOrder + 1
        );
        if (!empty($typeId)) {
            $aFields['media_type_id'] = $typeId;
        }
        return $this->da->updateMediaById($mediaId, $aFields);
    }

    public function getMedias($typeId = null, $fkId = null)
    {
        if (!empty($typeId)) {
            $aConstraints[] = 'm.media_type_id = ' . intval($typeId);
        }
        if (!empty($fkId)) {
            $aConstraints[] = 'm.fk_id = ' . intval($fkId);
        }
        $constraint = !empty($aConstraints)
            ? ' WHERE ' . implode(' AND ', $aConstraints)
            : '';
        $query = "
            SELECT    m.*, mt.name AS media_type
            FROM      media AS m
                      LEFT JOIN media_type AS mt
                        ON m.media_type_id = mt.media_type_id
                      $constraint
            ORDER BY  m.item_order ASC, m.date_created DESC
        ";
        return $this->dbh->getAll($query);
    }
}
?>