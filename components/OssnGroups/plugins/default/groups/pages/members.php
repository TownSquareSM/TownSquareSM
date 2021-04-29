<?php

/**

 * Open Source Social Network

 *

 * @package   Open Source Social Network

 * @author    Open Social Website Core Team <info@softlab24.com>

 * @copyright (C) SOFTLAB24 LIMITED

 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence

 * @link      https://www.opensource-socialnetwork.org/

 */

 //print_r($params['group']->guid); exit;

$members = $params['group']->getMembers();

$count = $params['group']->getMembers(true);

//print_r(ossn_loggedin_user()); exit;

//print_r($params['group']->isUserGroupAdmin($params['group']->guid,ossn_loggedin_user()->guid)); exit;

if ($members) {

    foreach ($members as $user) {

      ?>

		<div class="row">

	        <div class="ossn-group-members">

            	<div class="col-md-2 col-sm-2 hidden-xs">

    	        		<img src="<?php echo $user->iconURL()->large; ?>" width="100" height="100"/>

				</div>

                <div>

                   <div class="col-md-10 col-sm-10 col-xs-12">

    	    	        <div class="uinfo">

                          <?php

	    						echo ossn_plugin_view('output/url', array(

	    								'text' => $user->fullname,

	    								'href' =>  $user->profileURL(),

	    								'class' => 'userlink',

	    						));						

	    					?>

             	   		</div>

                    </div>

                    <div class="col-md-10 col-sm-10 col-xs-12">

                        <div class="right request-controls">

	                        <?php

	    						if ((ossn_isAdminLoggedin() || ossn_loggedin_user()->guid == $params['group']->owner_guid) && $user->guid !== $params['group']->owner_guid && $params['group']->isMember($params['group']->guid, $user->guid)) {

										echo ossn_plugin_view('output/url', array(

	    									'text' => ossn_print('group:memb:remove'),

	    									'href' =>  ossn_site_url("action/group/member/decline?group={$params['group']->guid}&user={$user->guid}", true),

		    								'class' => 'btn btn-warning btn-responsive ossn-make-sure'

		    						));

						        		echo ossn_plugin_view('output/url', array(

					    					'data-new-owner' => $user->fullname,

					    					'data-is-admin' => ossn_isAdminLoggedin(),

						    				'text' => ossn_print('group:memb:make:owner'),

						    				'href' =>  ossn_site_url("action/group/change_owner?group={$params['group']->guid}&user={$user->guid}", true),

						    				'class' => 'btn btn-danger btn-responsive ossn-group-change-owner'

						    		));

									if($params['group']->isUserGroupAdmin($params['group']->guid,$user->guid)) {

										echo ossn_plugin_view('output/url', array(

												'text' => "Remove as Group Admin",

												'href' =>  ossn_site_url("action/group/remove_group_admin?group={$params['group']->guid}&user={$user->guid}", true),

												'class' => 'btn btn-warning btn-responsive ossn-make-sure'

										));

									} else {

										echo ossn_plugin_view('output/url', array(

												'text' => "Make Group Admin",

												'href' =>  ossn_site_url("action/group/change_group_admin?group={$params['group']->guid}&user={$user->guid}", true),

												'class' => 'btn btn-success btn-responsive ossn-make-sure'

										));

									}

		    					} else if($params['group']->isUserGroupAdmin($params['group']->guid,ossn_loggedin_user()->guid) && $user->guid !== ossn_loggedin_user()->guid && $user->guid !== $params['group']->owner_guid) {

									echo ossn_plugin_view('output/url', array(

	    									'text' => ossn_print('group:memb:remove'),

	    									'href' =>  ossn_site_url("action/group/member/decline?group={$params['group']->guid}&user={$user->guid}", true),

		    								'class' => 'btn btn-warning btn-responsive ossn-make-sure'

		    						));

						        		echo ossn_plugin_view('output/url', array(

					    					'data-new-owner' => $user->fullname,

					    					'data-is-admin' => ossn_isAdminLoggedin(),

						    				'text' => ossn_print('group:memb:make:owner'),

						    				'href' =>  ossn_site_url("action/group/change_owner?group={$params['group']->guid}&user={$user->guid}", true),

						    				'class' => 'btn btn-danger btn-responsive ossn-group-change-owner'

						    		));


									if($params['group']->isUserGroupAdmin($params['group']->guid,$user->guid)) {

										echo ossn_plugin_view('output/url', array(

												'text' => "Remove as Group Admin",

												'href' =>  ossn_site_url("action/group/remove_group_admin?group={$params['group']->guid}&user={$user->guid}", true),

												'class' => 'btn btn-warning btn-responsive ossn-make-sure'

										));

									} else {

										echo ossn_plugin_view('output/url', array(

												'text' => "Make Group Admin",

												'href' =>  ossn_site_url("action/group/change_group_admin?group={$params['group']->guid}&user={$user->guid}", true),

												'class' => 'btn btn-success btn-responsive ossn-make-sure'

										));

									}		

								}

		    				?>		

                        </div>

                    </div>

               </div>

            </div>           

        </div>

    <?php

    }

	echo ossn_view_pagination($count);

}?>

