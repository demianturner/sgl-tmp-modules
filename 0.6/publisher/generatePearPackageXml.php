<?php
/**
 * Generation script for PEAR package.xml file.
 * Generates a version 2 package.xml file using the package
 * PEAR_PackageFileManager.
 *
 * @link http://pear.php.net/package/PEAR_PackageFileManager
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Frameworks
 * @package    Seagull
 * @subpackage publisher
 * @author     Demian Turner <demian@phpkitchen.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @link       http://www.seagullproject.org
 */

    /**
     * Package file manager for package.xml 2.
     */
    require_once 'PEAR/PackageFileManager2.php';

    /**
     * Some help functions.
     */
    #require_once 'generate_package_xml_functions.php';

    // Directory where the package files are located.
    $path = (defined('SGL_PKG_TMP_BUILD_DIR'))
       ? SGL_PKG_TMP_BUILD_DIR.'/modules/publisher'
       : dirname(__FILE__);
    $publisher_packagedir  = $path;

    // Name of the channel, this package will be distributed through
    $publisher_channel     = 'pear.phpkitchen.com';

    // Category and name of the package
    $publisher_category    = 'Seagull Modules';
    $publisher_package     = 'Seagull_publisher';

    $publisher_version     = '1.0';

    // Summary description
    $publisher_summary     = <<<EOT
The publisher module is Seagull's CMS.
EOT;

    // Longer description
    $publisher_description = <<<EOT
There are a wide range of features.
EOT;

    // License information
    $publisher_license = 'BSD';

    // Notes, function to grab them directly from S9Y in
    // generate_package_xml_functions.php
    $publisher_notes = <<<EOT
Publisher notes.
EOT;

    // Instantiate package file manager
    $publisher_pkg = new PEAR_PackageFileManager2();

    // Setting options
    $e = $publisher_pkg->setOptions(
        array(
            // Where are our package files.
            'packagedirectory'  => $publisher_packagedir,
            // Where will package files be installed in
            // the local PEAR repository?
            'baseinstalldir'    => 'Seagull/modules/publisher',
            // Where should the package file be generated
            'pathtopackagefile' => $publisher_packagedir,
            // Just simple output, no MD5 sums and <provides> tags
            #'simpleoutput'      => true,

            'packagefile'       => 'package2.xml',
            // Use standard file list generator, choose CVS, if you
            // have your code in CVS
            'filelistgenerator' => 'file',

            // List of files to ignore and put not explicitly into the package
            'ignore'            =>
            array(
                'package2.xml',
                '*tests*',
                '*.svn',
            ),

            // Global mapping of directories to file roles.
            // @see http://pear.php.net/manual/en/guide.migrating.customroles.defining.php
            'dir_roles'         =>
            array(
                'docs' => 'doc',
                'lib' => 'php',
                'modules' => 'php',
                'www' => 'web',
            ),

            'roles'             =>
            array(
                'php' => 'php',
                '*' => 'php',
            ),

            // Define exceptions of previously defined role mappings,
            // this part uses real file names and no directories.
            'exceptions'        =>
            array(
            ),
        )
    );

    // PEAR error checking
    if (PEAR::isError($e)) {
        die($e->getMessage());
    }

    // Set misc package information
    $publisher_pkg->setPackage($publisher_package);
    $publisher_pkg->setSummary($publisher_summary);
    $publisher_pkg->setDescription($publisher_description);
    $publisher_pkg->setChannel($publisher_channel);

    $publisher_pkg->setReleaseStability('beta');
    $publisher_pkg->setAPIStability('stable');
    $publisher_pkg->setReleaseVersion($publisher_version);
    $publisher_pkg->setAPIVersion($publisher_version);

    $publisher_pkg->setLicense($publisher_license);
    $publisher_pkg->setNotes($publisher_notes);

    // Our package contains PHP files (not C extension files)
    $publisher_pkg->setPackageType('php');

    // Must be available in new package.xml format
    $publisher_pkg->setPhpDep('4.3.0');
    $publisher_pkg->setPearinstallerDep('1.4.6');

    // Require PEAR_DB package for initializing the database in the post install script
    $publisher_pkg->addPackageDepWithChannel('required', 'HTTP', 'pear.php.net', '1.4.0');
    $publisher_pkg->addPackageDepWithChannel('required', 'HTTP_Header', 'pear.php.net', '1.2.0');
    $publisher_pkg->addPackageDepWithChannel('required', 'HTTP_Download', 'pear.php.net', '1.1.0');
    $publisher_pkg->addPackageDepWithChannel('required', 'HTML_TreeMenu', 'pear.php.net', '1.2.0');
    $publisher_pkg->addPackageDepWithChannel('required', 'Text_Statistics', 'pear.php.net', '1.0');
    $publisher_pkg->addPackageDepWithChannel('required', 'XML_Util', 'pear.php.net', '1.1.1');

    // Create the current release and add it to the package definition
    $publisher_pkg->addRelease();

    // Package release needs a maintainer
    $publisher_pkg->addMaintainer('lead', 'demianturner', 'Demian Turner', 'demian@phpkitchen.com');

    // Internally generate the XML for our package.xml (does not perform output!)
    $test = $publisher_pkg->generateContents();

if (!defined('SGL_PKG_TMP_BUILD_DIR'))    {
    if (isset($_GET['make']) || (isset($_SERVER['argv'][1]) &&
            $_SERVER['argv'][1] == 'make')) {
        #$e = $pkg->writePackageFile();
        $e = $publisher_pkg->writePackageFile();

        #$e = $packagexml->writePackageFile();
    } else {
        #$e = $pkg->debugPackageFile();
        $e = $publisher_pkg->debugPackageFile();
        #$e = $packagexml->debugPackageFile();
    }

    if (PEAR::isError($e)) {
        echo $e->getMessage();
    }
}

?>