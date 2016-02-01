<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
class EditorModel extends Database {

	private $_modelQuery = '';
	private $_queryResult = '';
	private $_returnStatus = '';

	public function __construct($cruidId = NULL, $params = array()) {
		parent::__construct();
	}

	protected function getNewsCategory() {
		/**
		 * Always add new category at the end of the array
		 */
		return array(
			'1' => 'MARKETS',
			'7' => 'Economy',
			'2' => 'Corporates',
			'4' => 'Investing',
			'3' => 'News',
			'5' => 'EARNINGS',
			'6' => 'BUDGETS',
			'8' => 'MUTUAL FUNDS',
			/*'9' => 'IPO',*/
			/*'10' => 'Wire News',*/
			'11' => 'Technical Corner',
			'12' => 'The Forecaster');
	}

	protected function getNewsCategorySeoDetails($catId) {
		/**
		 * Always add new category at the end of the array
		 */
		$seodetails = array(
			'1' => array('title' => 'Business News, Business Financial News, Stock Market Investing, Commodities – Dalal Times', 'description' => 'Dalal Times offers latest business news, financial news, stock markets tips, stock chart, market outlook, sensex, nifty, IPO, commodities news', 'keywords' => 'bombay stock exchange, Indian stock market, bse, nse, national stock exchange, sensex, stock market, trading, Indian stock market chart, stocks markets, ipo analysis, market analysis.'),
			'7' => array('title' => 'Indian Economy News, RBI, Credit Policy – Dalal Times', 'description' => 'Dalal Times provides latest news about economic growth of India, inflation, domestic market, industries and other economic news', 'keywords' => 'Indian Economy News, Economic News, Latest Economic News Graphics, RBI, Credit Policy'),
			'2' => array('title' => 'Corporate Buzz, Merger and Acquisition Action, Deal Street – Dalal Times', 'description' => 'Track latest Corporate Buzz, Mergers and Acquisition news, expert opinion on Dalal Times.', 'keywords' => 'current corporate buzz, Merger and Acquisition Action'),
			'4' => array('title' => 'Investing – Fixed Income, Property, Retirement, Loans, Property, Credit Card – Dalal Times', 'description' => 'Easiest step to know and manage personal finance which includes Insurance, Retirement planning, Property, Credit Card, Loans, Fixed Income, Tax news and updates on dalaltimes.com.', 'keywords' => 'Investment planning, Retirement, Insurance, Taxes, loans, Property and credit cards'),
			'3' => array('title' => 'Stocks, Corporates, Politics, Current Affair, Sports, World Business News', 'description' => 'Track latest news and updates on Indian Industry, Corporates, Politics, Current Affair and including sectorial news.', 'keywords' => 'Live Business News, Share Market Tips, Politics news, Current Affair, Global Market News, Stock Split News, Best Stock Market Tips, Sensex News, Nifty News.'),
			'5' => array('title' => 'India Earnings, Financial Results Analysis, Stock Earnings – Dalal Times', 'description' => 'Check quarterly and annuals results news and analysis of Indian companies and more at Dalal Times.', 'keywords' => 'Quarterly Results, Financial Results, Annual Results, Results Analysis.'),
			/*'9' => 'IPO',*/
			/*'10' => 'Wire News',*/
			'11' => array('title' => 'Technical Chart of the day on stocks and indices', 'description' => 'Get comprehensive technical analysis on stocks and indices', 'keywords' => 'Technical Analysis stocks, indices, nifty.'),
			'12' => array('title' => 'Forecasts and insights on the Stock Market and Indian economy.', 'description' => 'Official blog of Dalal Times founder Praveen Pathiyil', 'keywords' => 'Technical Analysis stocks, indices, nifty'),
		);
		return $seodetails[$catId];
	}

	protected function getNewsSubCategory($newsCategoryId) {
		/**
		 * Always add new category at the end of the array
		 */
		$subCategory = array(
			/*Market*/
			'1' => array('1' => 'Local Markets', '2' => 'Mark To Market', '3' => 'F&O Cues', '4' => 'Hot Money (FII Activity)', '5' => 'Funds (MF & DII Activity)', '6' => 'Market Outlook', '7' => 'Chart Check', '8' => 'Commodities', '9' => 'Currencies', '10' => 'Bonds', '11' => 'International Markets', '12' => 'Hot Cake (Buzzing)', '13' => 'Astrology', '14' => 'Heard On Street', '15' => 'IPO', /*'16' => 'The Forecaster', '17' => 'Chart of the Day',*/'18' => 'Morning Calls'),
			/*Corporates*/
			'2' => array('1' => 'Corporate Buzz', '2' => 'M&A Action', '3' => 'Deal Street', '4' => 'CEO Speaks/Mangement Corner', '5' => 'Legal', '6' => 'Startup Digest', '7' => 'Expert Speak'),
			/*News*/
			'3' => array('1' => 'Politics', '2' => 'World', '3' => 'Sports', '4' => 'Tech', '5' => 'Hastag', '6' => 'Current Affairs', '7' => 'Features', '8' => 'Press Release', '9' => 'Lifestyle'),
			/*Investing*/
			'4' => array('1' => 'PF for Dummies', '2' => 'Fund Mantra', '3' => 'Your Money', '4' => 'Retirement', '5' => 'Real Estate', '6' => 'Tax', '7' => 'Insurance'),
			/*EARNINGS*/
			'5' => array('1' => 'Results', '2' => 'Result Poll', '3' => 'Result Analysis', '4' => 'Results Boardroom', '5' => 'Results- Brokerage Conference Call', '6' => 'Results- Company Press Conference', '7' => 'FIIs on Results'),
			/*BUDGETS*/
			'6' => array('1' => 'Budget News', '2' => 'Budget Columns', '3' => 'Budget Interview', '4' => 'Budget Stock Pick'),
			/*Economy*/
			'7' => array('1' => 'Budget', '2' => 'Decoder', '3' => 'World Economy', '4' => '360 Degree', '5' => 'Micros', '6' => 'Macros', '7' => 'Policy Makers'),
			/*MUTUAL FUNDS*/
			/*'8' => array('1' => 'MF-Analysis', '2' => 'MF-News', '3' => 'MF-Interview', '4' => 'MF Experts'),*/
			'8' => array(),
			/*IPO*/
			/*'9' => array('1' => 'IPO - News', '2' => 'IPO - Issues Open', '3' => 'IPO - Tip', '4' => 'IPO - New Listings', '5' => 'IPO - Listing Strategy', '6' => 'IPO - Upcoming Issues'),*/
			'9' => array(),
			/*Wire News*/
			'10' => array(),
			'11' => array('1'=>'Sensex Rider', '2'=>'Nifty Rider'),
			'12' => array());
		return $subCategory[$newsCategoryId];
	}

	protected function getNewsSource() {
		return array(
			'1' => 'Team Dalal Times',
			'2' => 'PTI',
			'3' => 'Reuters',
		);
	}
	protected function getArticleDetails($fields) {
		$this->_modelQuery = 'SELECT nup.*, cu.employee_name as author_name, cu1.employee_name as publisher_name, img_bnk.image_300, img_bnk.image_615, img_bnk.image_100, img_bnk.image_77, img_bnk.image_1280, img_bnk.image_1600,img_bnk.image_courtesy,img_bnk.image_name FROM `news_unpublish` nup LEFT JOIN image_bank img_bnk ON img_bnk.image_id = nup.image_id LEFT JOIN cms_users cu ON nup.author_id = cu.cms_id LEFT JOIN cms_users cu1 ON nup.publisher_id = cu1.cms_id where autono = :autono';
		$this->query($this->_modelQuery);
		$this->bindByValue('autono', $fields['articleId']);
		$this->_queryResult = $this->single();
		if ($this->_queryResult['related_story'] != '') {
			$this->_modelQuery = 'SELECT headline FROM `news_unpublish` nup where autono = :autono';
			$this->query($this->_modelQuery);
			$this->bindByValue('autono', $this->_queryResult['related_story']);
			$relatedHeadline = $this->single();
			$fields['related_heading'] = $relatedHeadline['headline'];
		}

		$this->_modelQuery = 'select file_path from news_attachments na JOIN attachments attach ON na.attachment_id = attach.attachment_id WHERE article_id = :article_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('article_id', $fields['articleId']);
		$news_attachments = $this->resultset();
		$attachments = array();
		foreach ($news_attachments as $key => $value) {
			$attachments[] = $value['file_path'];
		}

		$fields['heading'] = $this->_queryResult['headline'];
		$fields['sms_heading'] = $this->_queryResult['sms_heading'];
		$fields['summary'] = $this->_queryResult['summary'];
		$fields['news_content'] = $this->_queryResult['content'];
		$fields['publish_date'] = date('Y-m-d H:i:s', strtotime($this->_queryResult['publish_date']));
		$fields['disp_date'] = date('M d, Y H:iA', strtotime($this->_queryResult['publish_date']));
		$fields['mod_date'] = date('Y-m-d H:i:s', strtotime($this->_queryResult['mod_date']));
		$fields['author_id'] = $this->_queryResult['author_id'];
		$fields['author_name'] = $this->_queryResult['author_name'];
		$fields['publisher_id'] = $this->_queryResult['publisher_id'];
		$fields['publisher_name'] = $this->_queryResult['publisher_name'];
		$fields['news_category'] = $this->_queryResult['category_id'];
		$fields['news_subcategory'] = $this->_queryResult['sub_category_id'];
		$fields['news_source'] = $this->_queryResult['source_id'];
		$fields['news_source_name'] = $this->_queryResult['source_id'];
		$fields['keywords'] = $this->_queryResult['keywords'];
		$fields['image_id'] = $this->_queryResult['image_id'];
		$fields['image_courtesy'] = $this->_queryResult['image_courtesy'];
		$fields['image_name'] = $this->_queryResult['image_name'];
		$fields['image_300'] = $this->_queryResult['image_300'];
		$fields['image_615'] = $this->_queryResult['image_615'];
		$fields['image_100'] = $this->_queryResult['image_100'];
		$fields['image_1280'] = $this->_queryResult['image_1280'];
		$fields['image_77'] = $this->_queryResult['image_77'];
		$fields['image_1600'] = $this->_queryResult['image_1600'];
		$fields['related_story'] = $this->_queryResult['related_story'];
		$fields['publish'] = $this->_queryResult['publish'];
		$fields['attachments'] = $attachments;
		$fields['transfer_to_newspublish_tbl'] = $this->_queryResult['transfer_to_newspublish_tbl'];
		$fields['assign_to_prod'] = $this->_queryResult['assign_to_production'];
		if ($fields['assign_to_prod'] == 1) {
			$fields['assign_to_production'] = true;
		} else {
			$fields['assign_to_production'] = false;
		}
		$fields['last_updated_by'] = $this->_queryResult['last_updated_by'];
		return $fields;
	}
}
?>
