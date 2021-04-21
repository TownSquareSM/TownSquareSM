<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnAds extends OssnObject {
		/**
		 * Add a new ad in system.
		 *
		 * @return bool;
		 */
		public function addNewAd($params) {
				self::initAttributes();
				
				$this->title          = $params['title'];
				$this->description    = $params['description'];
				$this->data->site_url = $params['siteurl'];
				$this->data->ad_html  = $params['html'];
				$this->data->iframe_height = $params['iframe_height'];
				
				$this->owner_guid = 1;
				$this->type       = 'site';
				$this->subtype    = 'ossnads';
				// if(empty($_FILES['ossn_ads']['tmp_name'])) {
				// 		return false;
				// }
				$add = $this->addObject();
				if($add) {
						if(isset($_FILES['ossn_ads']) && $_FILES['ossn_ads']['size'] !== 0) {
								$this->OssnFile->owner_guid = $this->getObjectId();
								$this->OssnFile->type       = 'object';
								$this->OssnFile->subtype    = 'ossnads';
								$this->OssnFile->setFile('ossn_ads');
								$this->OssnFile->setExtension(array(
										'jpg',
										'png',
										'jpeg',
										'gif'
								));
								$this->OssnFile->setPath('ossnads/images/');
								$this->OssnFile->addFile();
						}
						// save html file
						$iframe_dir = ossn_get_userdata("object/{$this->getObjectId()}/ossnads/iframe/");
						if(!is_dir($iframe_dir)) {
							mkdir($iframe_dir, 0755, true);
						}
						$filedir = "{$iframe_dir}{$this->getObjectId()}.html";
						$file = fopen($filedir, "w");
						$content = $params['html'];
						$content = str_replace(array('\r\n', '\n'), "", $content);
						$content = html_entity_decode($content);
						fwrite($file, $content);
						$this->owner_guid = $this->getObjectId();
						$this->type       = 'object';
						$this->subtype    = 'html:ossnads';
						$this->value      = "ossnads/iframe/{$this->getObjectId()}.html";
						$this->extension  = 'html';
						$this->path       = 'ossnads/iframe/';
						$this->add();
						fclose($file);
						return $add;
				}
				return false;
		}

		/**
		 * Set timer for ad rotation.
		 * 
		 * @return bool;
		 */
		public function set_ad_timer($params) {
			$param = array();
			$param['type']       = 'site';
			$param['subtype']    = 'ossnads:timer';
			$param['owner_guid'] = 1;
			
			$timer = $this->searchObject($param);

			if($timer && count($timer) == 1) {
				$this->guid = $timer[0]->guid;
			}

			$this->title       = $params['title'];
			$this->description = $params['timer'];
			$this->owner_guid  = $param['owner_guid'];
			$this->type        = $param['type'];
			$this->subtype     = $param['subtype'];

			if($this->save()) {
				return true;
			}
			return false;
		}

		public function get_ad_timer() {
			$param = array();
			$param['type']       = 'site';
			$param['subtype']    = 'ossnads:timer';
			$param['owner_guid'] = 1;
			
			$timer = $this->searchObject($param);

			if($timer && count($timer) == 1) {
				return $timer[0];
			}
			return false;
		}
		
		/**
		 * Initialize the objects.
		 *
		 * @return void;
		 */
		public function initAttributes() {
				$this->OssnDatabase = new OssnDatabase;
				$this->OssnFile     = new OssnFile;
				$this->data         = new stdClass;
		}
		
		/**
		 * Get site ads.
		 *
		 * @param array $params option values
		 * @param boolean $random do you wanted to see ads in ramdom order?
		 *
		 * @return array|boolean|integer
		 */
		public function getAds(array $params = array(),  $random = true) {
				$options = array(
						'owner_guid' => 1,
						'type' => 'site',
						'subtype' => 'ossnads',
						'order_by' => 'rand()'
				);
				if(!$random){
						unset($options['order_by']);			
				}
				$args    = array_merge($options, $params);
				return $this->searchObject($args);
		}
		/**
		 * Get ad entity
		 * 
		 * @param (int) $guid ad guid
		 *
		 * @return object;
		 */
		public function getAd($guid) {
				$this->object_guid = $guid;
				return $this->getObjectById();
		}
		/**
		 * Delete ad
		 * 
		 * @param (int) $ad ad guid
		 *
		 * @return bool;
		 */
		public function deleteAd($ad) {
				if($this->deleteObject($ad)) {
						return true;
				}
				return false;
		}
		/**
		 * Edit
		 * 
		 * @param (array) $params Contain title , description and guid of ad
		 *
		 * @return bool;
		 */
		public function EditAd($params) {
				self::initAttributes();
				if(!empty($params['guid']) && !empty($params['html']) && !empty($params['iframe_height']) && !empty($params['siteurl'])) {
						$entity               = get_ad_entity($params['guid']);
						$fields               = array(
								'title',
								'description'
						);
						$data                 = array(
								$params['title'],
								$params['description']
						);
						$this->data->site_url = $params['siteurl'];
						$this->data->ad_html = $params['html'];
						$this->data->iframe_height = $params['iframe_height'];
						if($this->updateObject($fields, $data, $entity->guid)) {
								if(isset($_FILES['ossn_ads']) && $_FILES['ossn_ads']['size'] !== 0) {
										$path         = $entity->getParam('file:ossnads');
										if(!empty($path)) {
											$replace_file = ossn_get_userdata("object/{$entity->guid}/{$path}");
											$regen_image = ossn_resize_image($_FILES['ossn_ads']['tmp_name'][0], 2048, 2048);
											file_put_contents($replace_file, $regen_image);
										} else {
											$this->OssnFile->owner_guid = $params['guid'];
											$this->OssnFile->type       = 'object';
											$this->OssnFile->subtype    = 'ossnads';
											$this->OssnFile->setFile('ossn_ads');
											$this->OssnFile->setExtension(array(
													'jpg',
													'png',
													'jpeg',
													'gif'
											));
											$this->OssnFile->setPath('ossnads/images/');
											$this->OssnFile->addFile();
										}
								}
								// save html file
								$filedir = $entity->getParam('html:ossnads');
								$filedir = ossn_get_userdata("object/{$entity->guid}/{$filedir}");
								$file = fopen($filedir, "w");
								$content = $params['html'];
								$content = nl2br($content);
								$content = str_replace(array('\r\n', '\n'), "", $content);
								$content = html_entity_decode($content);
								fwrite($file, $content);
								$this->owner_guid = $this->getObjectId();
								$this->type       = 'object';
								$this->subtype    = 'html:ossnads';
								$this->value      = "ossnads/iframe/{$this->getObjectId()}.html";
								$this->extension  = 'html';
								$this->path       = 'ossnads/iframe/';
								$this->add();
								fclose($file);
								return true;
						}
				}
				return false;
		}
		
} //class
