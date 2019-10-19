<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * Manages RBAC for application.
 *
 * @package console\controllers
 */
class RbacController extends Controller
{
    /**
     * Initializes RBAC for application.
     * Command for execute : yii rbac/init
     *
     * @throws \yii\base\Exception
     */
    public function actionInit()
    {
        $o_auth_manager = Yii::$app->authManager;

        // Creates permission for to manage backend.
        $o_permission_backend = $o_auth_manager->createPermission('manageBackend');
        $o_permission_backend->description = 'Allows manage backend';
        $o_auth_manager->add($o_permission_backend);

        // Creates role "admin" and adds permission "manageBackend".
        $o_role_admin = $o_auth_manager->createRole('admin');
        $o_auth_manager->add($o_role_admin);
        $o_auth_manager->addChild($o_role_admin, $o_permission_backend);
    }

    /**
     * Assigns role "admin" for user.
     * Command for execute : yii rbac/assign-admin 'id'
     *
     * @param string $id Primary key of user which should be assigned as "admin".
     * @throws \Exception
     */
    public function actionAssignAdmin(string $id)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole('admin');
        $auth->assign($role, $id);
    }
}