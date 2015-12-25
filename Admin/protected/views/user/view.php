<div id='edit-order-page' class='row-fluid'>
	<div class='row-fluid'>
		<div class='span12 box bordered-box blue-border'>
			<div class='box-content box-padding'>
				<fieldset>
					<div class='span12'>
						<div class='control-group'>
							<label class='control-label'>用户编号： <small class='muted'><?php echo $data['id']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>用户性别： <small class='muted'><?php echo $data['id']=1?'男':'女'?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>用户名： <small class='muted'><?php echo $data['nickName']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>用户头衔： <small class='muted'><?php echo $data['title']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>用户角色： <small class='muted'><?php echo $data['role']==1?'老板':'员工'?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>职业： <small class='muted'><?php echo $data['work']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>工作楼层： <small class='muted'><?php echo $data['floor']?></small></label>
						</div>	
						<div class='control-group'>
							<label class='control-label'>用户联系方式： <small class='muted'><?php echo $data['mobile']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>所在公司： <small class='muted'><?php echo $data['companyid']['name']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>用户类型： <small class='muted'><?php echo $data['usertypeid']['name']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>用户出生日期： <small class='muted'><?php echo substr($data['birthday'],0,10)?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>用户被关注数目： <small class='muted'><?php echo $data['followers']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>常用办公地点： <small class='muted'><?php echo $data['locationid']['name']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>技能： <small class='muted'><?php echo $data['skills']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>爱好： <small class='muted'><?php echo $data['interests']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>用户邮箱： <small class='muted'><?php echo $data['email']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>用户网站： <small class='muted'><?php echo $data['website']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>WechatID： <small class='muted'><?php echo $data['wechatid']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>FacebookID： <small class='muted'><?php echo $data['facebookid']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>TwitterID： <small class='muted'><?php echo $data['twitterid']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>InstagramID： <small class='muted'><?php echo $data['instagramid']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>LinkedInID： <small class='muted'><?php echo $data['linkedinid']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>用户简介： <small class='muted'><?php echo $data['description']?></small></label>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
	</div>
</div>