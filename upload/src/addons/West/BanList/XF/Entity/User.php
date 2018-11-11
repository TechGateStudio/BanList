<?php

namespace West\BanList\XF\Entity;

class User extends XFCP_User
{
	public function canViewBanList()
	{
		return $this->hasPermission('general', 'w_bl_can_view_banlist');
	}
}