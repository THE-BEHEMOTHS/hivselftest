<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resources extends MY_Controller {
	protected $asset_url;

	protected $pageTitle;
	protected $pageDescription;
	protected $contentView;
	protected $contentViewData;
	protected $metaData;
	protected $modalView;
	protected $modalData;
	protected $modalTitle;

	function __construct(){
		parent::__construct();

		$this->asset_url = $this->config->item('assets_url');
		$this->load->library('Assets', $this->config);
	}

	public function index()
	{
		echo "This is the resources controller";exit;
	}

	public function what_is_prep()
	{
		$data = '';
		$this->template
				->setPartial('Resources/index_v', $data)
				->frontEndTemplate();
	}

	public function get($type = NULL){
		$resources = [];

		$resources['videos'][] = [
			'_video_title' 	=>	"NASCOP Launches HIV Prevention Drug",
			'_video_id'	=>	"9I0_e1Igg2U"
		];

		$resources['videos'][] = [
			'_video_title' 	=>	"HIV Self Testing Discussion",
			'_video_id'	=>	"H9y4uImw5V8"
		];

		$resources['videos'][] = [
			'_video_title' 	=>	"WAR on HIV(Citizen TV)",
			'_video_id'	=>	"Z4o90zghY5A"
		];

		$resources['sites'][] = [
			'title'		=>	"Government Launches Two Approaches",
			'link'		=>	"http://www.nation.co.ke/news/Govt-launches-two-approaches-to-fight-HIV-Aids/1056-3914614-8p6ubc/",
			'thumb'		=>	"img/resources/govt_launch.PNG"
		];

		$resources['sites'][] = [
			'title'		=>	"Stardand Digital Home Test Kits",
			'link'		=>	"https://www.standardmedia.co.ke/health/article/2001238625/hiv-home-test-kits-now-in-kenya",
			'thumb'		=>	"img/resources/standard_home_kits.PNG"
		];

		$resources['sites'][] = [
			'title'		=>	"Kenya Launches Self Test Kits",
			'link'		=>	"http://www.unaids.org/en/resources/presscentre/featurestories/2017/may/20170505_kenya",
			'thumb'		=>	"img/resources/unaids_self_test.PNG"
		];

		$resources['audio'][] = [
			'title'			=>	"Government to distribute Prep Pill",
			'link'			=>	"audio/Govt_to_distribute_Prep_pill.mp3",
			'source'		=>	"XFM",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://cdn-radiotime-logos.tunein.com/s253517q.png"
		];

		$resources['audio'][] = [
			'title'			=>	"Public advised on HIV test",
			'link'			=>	"audio/Public_advised_on_HIV_test.mp3",
			'source'		=>	"XFM",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://cdn-radiotime-logos.tunein.com/s253517q.png"
		];

		$resources['audio'][] = [
			'title'			=>	"Kenya rolls out PreP drugs to fight HIV",
			'link'			=>	"audio/Kenya_rolls_out_Prep_drugs_to_fight_HIV.mp3",
			'source'		=>	"Radio Jambo",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://cdn-radiotime-logos.tunein.com/s253512q.png"
		];

		$resources['audio'][] = [
			'title'			=>	"NASCOP says HIV tests is voluntary",
			'link'			=>	"audio/NASCOP_says_HIV_tests_is_voluntary.mp3",
			'source'		=>	"Radio Jambo",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://cdn-radiotime-logos.tunein.com/s253512q.png"
		];

		$resources['audio'][] = [
			'title'			=>	"Government to roll out HIV prevention drugs",
			'link'			=>	"audio/Govt_to_roll_out_HIV_prevention_drugs.mp3",
			'source'		=>	"Pwani FM",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://www.kenyaminingforum.com/uploads/174/ImageManager/Pwani_FM.jpg"
		];

		$resources['audio'][] = [
			'title'			=>	"Government launches free HIV prevention drugs",
			'link'			=>	"audio/Govt_launches_free_HIV_prevention_drugs.mp3",
			'source'		=>	"Baraka FM",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"https://goretykestercommunications.com/img/005.png"
		];

		$resources['audio'][] = [
			'title'			=>	"Government gives HIV prevention medicine for free",
			'link'			=>	"audio/Govt_gives_HIV_prevention_medicine_for_free.mp3",
			'source'		=>	"Mbaitu FM",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"https://static-media.streema.com/media/cache/40/35/40351616e3478dc5b9d3b80b6d3a6253.jpg"
		];

		$resources['audio'][] = [
			'title'			=>	"Government launches new HIV/AIDS drug,self testing kit",
			'link'			=>	"audio/Govt_launches_new_HIV_AIDS_drug_self_testin_kit.mp3",
			'source'		=>	"West FM",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"https://lh3.googleusercontent.com/nPghm-GaSaK8-9LbTofHQ3snxPWYnPw2xMF_DksACHoLPlKX0LITOK9rzn32Ky0wvw=w300"
		];

		$resources['audio'][] = [
			'title'			=>	"Kenya rolls out HIV prevention drugs",
			'link'			=>	"audio/Kenya_rolls_out_HIV_prevention_drugs.mp3",
			'source'		=>	"Ghetto Radio",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"https://kituochasheria.files.wordpress.com/2015/11/hzeiyowm_400x400.jpeg"
		];

		$resources['audio'][] = [
			'title'			=>	"Government launches free HIV prevention drugs",
			'link'			=>	"audio/Govt_launches_free_HIV_prevention_drugs_2.mp3",
			'source'		=>	"One FM",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"https://pbs.twimg.com/profile_images/1610495604/1FM_logo_400x400.jpg"
		];

		$resources['audio'][] = [
			'title'			=>	"People at risk of getting HIV can now access PrEP",
			'link'			=>	"audio/People_at_risk_of_getting_HIV_can_now_access_PrEP.mp3",
			'source'		=>	"Bahari FM",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://cdn-radiotime-logos.tunein.com/s230393q.png"
		];

		$resources['audio'][] = [
			'title'			=>	"Government to roll out HIV prevention drugs",
			'link'			=>	"audio/Govt_to_roll_out_HIV_prevention_drugs_2.mp3",
			'source'		=>	"Classic 105",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://www.radioafrican.com/wp-content/uploads/2015/10/Classic-105.2-FM.jpg"
		];

		$resources['audio'][] = [
			'title'			=>	"Kenyans urged to acquire HIV self test kits",
			'link'			=>	"audio/Kenyans_urged_to_acquire_HIV_self_test_kits.mp3",
			'source'		=>	"Classic 105",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://www.radioafrican.com/wp-content/uploads/2015/10/Classic-105.2-FM.jpg"
		];

		$resources['audio'][] = [
			'title'			=>	"NASCOP says HIV tests are voluntary",
			'link'			=>	"audio/NASCOP_says_HIV_tests_are_voluntary.mp3",
			'source'		=>	"Classic 105",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://www.radioafrican.com/wp-content/uploads/2015/10/Classic-105.2-FM.jpg"
		];

		$resources['audio'][] = [
			'title'			=>	"NASCOP launches PrEP to boost war against HIV",
			'link'			=>	"audio/NASCOP_launches_PrEP_to_boost_war_against_HIV.mp3",
			'source'		=>	"Radio Waumini",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"https://pbs.twimg.com/profile_images/634337374558748672/-owC61jM.jpg"
		];

		$resources['audio'][] = [
			'title'			=>	"HIV home test kits now in Kenya",
			'link'			=>	"audio/HIV_home_test_kits_now_in_Kenya.mp3",
			'source'		=>	"Urban Radio",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://www.electronicmedia.co.za/images/urban1.jpg"
		];

		$resources['audio'][] = [
			'title'			=>	"Kenyans urged to take HIV tests voluntarily",
			'link'			=>	"audio/Kenyans_urged_to_take_HIV_tests_voluntarily.mp3",
			'source'		=>	"Kiss FM",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://www.sde.co.ke/sdemedia/sdeimages/pulse/kiss100fm110814.jpg"
		];

		$resources['audio'][] = [
			'title'			=>	"Sex workers happy over the HIV prevention pills",
			'link'			=>	"audio/Sex_workers_happy_over_the_HIV_prevention_pills.mp3",
			'source'		=>	"Kiss FM",
			'date'			=>	"Friday, May 05 2017",
			'station_url'	=>	"http://www.sde.co.ke/sdemedia/sdeimages/pulse/kiss100fm110814.jpg"
		];

		$response = (!$type) ? $resources : $resources[$type];

		return $response;
	}

}

?>