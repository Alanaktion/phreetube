<?php
namespace Controller;

class User extends \Controller
{

    /**
     * GET /login
     * @param  \Base $fw
     */
    function login(\Base $fw)
    {
        if($fw->get('_user')) {
            $fw->reroute('/dashboard');
        }
        $this->render('user/login.html');
    }

    /**
     * POST /login
     * @param  \Base $fw
     */
    function loginPost(\Base $fw)
    {
        if($fw->get('POST.username') && $fw->get('POST.password')) {
            $user = new \Model\User;
            $user->load(['username = ?', $fw->get('POST.username')]);
            if(password_verify($fw->get('POST.password'), $user->password_hash)) {
                $fw->set('SESSION.user_id', $user->id);
                $fw->reroute('/dashboard');
            } else {
                $fw->set('_error', 'Invalid username or password.');
            }
        } else {
            $fw->set('_error', 'Please enter a username and password.');
        }

        $this->render('user/login.html');
    }

    /**
     * GET /u/@username
     * @param  \Base $fw
     * @param  array $params
     */
    function view(\Base $fw, array $params)
    {
        $user = new \Model\User;
        $user->load(['username = ?', $params['username']]);
        if(!$user->id) {
            $fw->error(404);
        }
        $fw->set('user', $user);

        $video = new \Model\Video;
        $videos = $video->find(['user_id = ?', $user->id]);
        $fw->set('videos', $videos);

        $this->render('user/view.html');
    }


}
