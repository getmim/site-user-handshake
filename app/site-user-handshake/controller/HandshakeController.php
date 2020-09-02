<?php
/**
 * HandshakeController
 * @package site-user-handshake
 * @version 0.0.1
 */

namespace SiteUserHandshake\Controller;

use LibUserAuthHandshake\Library\Handshake;
use LibUserAuthCookie\Authorizer\Cookie;
use LibUserAuthCookie\Model\UserAuthCookie as UACookie;

class HandshakeController extends \Site\Controller
{
	public function deliverAction(){
		if(!$this->user->isLogin())
			return $this->show404();

		$next = $this->req->getQuery('next');
		if(!$next)
			return $this->show404();

		$session = $this->user->getSession();

		$token = Handshake::generate($this->user->id, $session->id);

		$next.= (false!==strstr($next,'?')?'&':'?') . 'token=' . $token;

		$this->res->redirect($next);
	}

	public function receiveAction(){
		$next = $this->req->getQuery('next');
		if(!$next)
			$next = $this->router->to('siteHome');

		$token= $this->req->getQuery('token');

		$data = Handshake::validate($token);
		if(!$data)
			return $this->show404();

		$session = UACookie::getOne(['id'=>$data->session,'user'=>$data->user]);
		if(!$session){
			Cookie::setKeep(false);
			Cookie::loginById($data->user);
		}else{
			$config      = $this->config->libUserAuthCookie;
			$cookie_name = $config->cookie;
			$this->res->addCookie($cookie_name, $session->hash, 0);
		}

		$this->res->redirect($next);
	}
}