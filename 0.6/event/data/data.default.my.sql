INSERT INTO module VALUES ({SGL_NEXT_ID}, 0, 'event', 'Events', 'For managing calendar and event functionality.', NULL, '48/module_contactus.png', 'Demian Turner', NULL, 'GPL', 'devel');

SELECT @moduleId := MAX(module_id) FROM module;

INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'calendarmgr', '', @moduleId);
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'eventmgr', '', @moduleId);
INSERT INTO permission VALUES ({SGL_NEXT_ID}, 'locationmgr', '', @moduleId);

#member role perms
SELECT @permissionId := permission_id FROM permission WHERE name = 'calendarmgr';
INSERT INTO role_permission VALUES ({SGL_NEXT_ID}, 2, @permissionId);
SELECT @permissionId := permission_id FROM permission WHERE name = 'eventmgr';
INSERT INTO role_permission VALUES ({SGL_NEXT_ID}, 2, @permissionId);
SELECT @permissionId := permission_id FROM permission WHERE name = 'locationmgr';
INSERT INTO role_permission VALUES ({SGL_NEXT_ID}, 2, @permissionId);

#remove after devel
#SELECT @permissionId := permission_id FROM permission WHERE name = 'maintenancemgr';
#INSERT INTO role_permission VALUES ({SGL_NEXT_ID}, 2, @permissionId);


INSERT INTO `event_type` VALUES (1, 'General');
INSERT INTO `event_type` VALUES (2, 'Event');
INSERT INTO `event_type` VALUES (3, 'News');
INSERT INTO `event_type` VALUES (4, 'Seminar');
INSERT INTO `event_type` VALUES (5, 'Exhibition');
INSERT INTO `event_type` VALUES (6, 'Tour');
INSERT INTO `event_type` VALUES (7, 'Holiday');


INSERT INTO `location_type` VALUES (1, 'Gallery');
INSERT INTO `location_type` VALUES (2, 'Park');
INSERT INTO `location_type` VALUES (3, 'Theatre');
INSERT INTO `location_type` VALUES (4, 'Exhibition Hall');

