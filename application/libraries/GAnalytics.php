<?php

class GAnalytics{
	protected $ci, $scopes, $analytics, $profileId;
	function __construct(){
		$this->ci = & get_instance();
		$this->ci->load->config('googleanalytics');
		$this->scopes = [
			'https://www.googleapis.com/auth/analytics.readonly'
		];

		$this->initializeAnalytics();		
	}

	function initializeAnalytics(){
		$client = new Google_Client();
		$client->setApplicationName("Be Sure App");
		$client->setAuthConfig($this->ci->config->item('key_file'));
		$client->setScopes($this->scopes);

		$this->analytics = new Google_Service_Analytics($client);
		$this->getFirstProfileId();
		return;
	}

	function getFirstProfileId(){
		$accounts = $this->analytics->management_accounts->listManagementAccounts();

		if (count($accounts->getItems()) > 0) {
			$items = $accounts->getItems();
			$firstAccountId = $items[0]->getId();

			$properties = $this->analytics->management_webproperties->listManagementWebproperties($firstAccountId);
			if (count($properties->getItems()) > 0) {
				$items = $properties->getItems();
				$firstPropertyId = $items[0]->getId();

				$profiles = $this->analytics->management_profiles->listManagementProfiles($firstAccountId, $firstPropertyId);
				if (count($profiles->getItems()) > 0) {
					$items = $profiles->getItems();
					$this->profileId = $items[0]->getId();
					return;
				}else{
					throw new Exception('No views (profiles) found for this user.');
				}
			}else{
				throw new Exception('No properties found for this user.');
			}
		}else{
			throw new Exception('No accounts found for this user.');
		}
	}

	function getResults($quota = NULL){
		$page_views = NULL;
		$total_views = $week_views = "";
		$quota = ($quota == NULL) ? "all" : $quota;

		$results = $this->analytics->data_ga->get(
				'ga:' . $this->profileId,
				'2008-01-01',
				'today',
				'ga:sessions'
		);

		if (count($results->getRows()) > 0) {
			$rows = $results->getRows();
			$total_views = $rows[0][0];
		}

		$results = $this->analytics->data_ga->get(
			'ga:' . $this->profileId,
			'7daysAgo',
			'today',
			'ga:sessions'
		);

		if (count($results->getRows()) > 0) {
			$rows = $results->getRows();
			$week_views = $rows[0][0];
		}

		$page_views = $week_views . '/' . $total_views;
		return $page_views;
	}
}