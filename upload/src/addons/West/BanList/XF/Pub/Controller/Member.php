<?php

namespace West\BanList\XF\Pub\Controller;

class Member extends XFCP_Member
{
	public function actionBanlist() 
	{
		if (!\XF::visitor()->canViewBanList()) {
			return $this->noPermission();
		}
		$bannedUsers = \XF::finder("XF:UserBan");
		
		$page = $this->filterPage();
		$perPage = 25;

		$bannedUsers->limitByPage($page, $perPage);
		
		$total = $bannedUsers->total();

		$this->assertValidPage($page, $perPage, $total, 'members/banlist');

		$viewParams = [
			'bannedUsers' => $bannedUsers->order('ban_date', 'DESC')->fetch(),
			'page' => $page,
			'perPage' => $perPage,
			'total' => $total
		];

		return $this->view(null, "w_bl_banlist", $viewParams);
	}
}