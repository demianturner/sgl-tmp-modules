-- Last edited: Antonio J. Garcia 2007-04-24
-- data for /newsletter
-- leave subqueries on a single line in order that table prefixes works

BEGIN;


INSERT INTO module VALUES ({SGL_NEXT_ID}, 1, 'newsletter', 'Newsletter', 'The ''Newsletter'' module is a simple mass mailer module that allows you to create an HTML formatted message or newsletter, and send it to all your registered users, or on a group by group basis, in a single click.', 'newsletter/list', 'newsletter.png', '', NULL, NULL, NULL);

INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_list', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_send', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_addressBook', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_listSubscribers', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_editSubscriber', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_updateSubscriber', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_deleteSubscriber', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_listLists', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_addList', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_editList', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_updateList', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_deleteLists', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_exportSubscribers', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_addSubscriber', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'listmgr_cmd_insertSubscriber', NULL, (
    SELECT max(module_id) FROM module
    ));
    
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'newslettermgr', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'newslettermgr_cmd_list', '', (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'newslettermgr_cmd_subscribe', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'newslettermgr_cmd_unsubscribe', NULL, (
    SELECT max(module_id) FROM module
    ));
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'newslettermgr_cmd_authorize', NULL, (
    SELECT max(module_id) FROM module
    ));

INSERT INTO newsletter VALUES (1,'general','To stay informed you may join our general discussion list.','',9,'','','2005-02-28 19:44:32','2005-02-28 19:44:32');


COMMIT;

