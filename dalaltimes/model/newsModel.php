<?php

require_once _CONST_MODEL_PATH . 'editorModel.php';
class NewsModel extends EditorModel {

	private $_modelQuery = '';
	private $_queryResult = '';

	public function __construct($cmsUserId = NULL, $cmsUserParams = array()) {
		parent::__construct();
		$this->_commonFunction = new CommonFunctions();
	}

	protected function getNewsCount($search = array()) {
		$where_condition = array();
		if (isset($search['publish_status'])) {
			$where_condition[] = ' publish = "' . $search['publish_status'] . '"';
		}
		if (isset($search['autono']) && $search['autono'] != '') {
			$where_condition[] .= ' autono = "' . $search['autono'] . '"';
		} else {
			if (isset($search['category_id']) && $search['category_id'] != '') {
				$where_condition[] .= ' category_id = "' . $search['category_id'] . '"';
			}
			if (isset($search['subcategory_id']) && $search['subcategory_id'] != '') {
				$where_condition[] .= ' sub_category_id = "' . $search['subcategory_id'] . '"';
			}
			if (isset($search['date_range']) && !empty($search['date_range'][0]) && !empty($search['date_range'][1])) {
				$where_condition[] .= ' modified_date BETWEEN "' . $search['date_range'][0] . '" and "' . $search['date_range'][1] . '"';
			}
			if (isset($search['exclude_autono'])) {
				if (is_array($search['exclude_autono'])) {
					$where_condition[] .= ' autono NOT IN (' . implode(",", $search['exclude_autono']) . ')';
				} else if ($search['exclude_autono'] != '') {
					$where_condition[] .= ' autono != "' . $search['exclude_autono'] . '"';
				}
			}
			if (isset($search['headline']) && $search['headline'] != '') {
				$where_condition[] .= ' headline like "%' . $search['headline'] . '%"';
			}
		}
		if (!empty($where_condition)) {
			$where_condition = 'where ' . implode(' and ', $where_condition);
		}
		if (isset($search['tbl'])) {
			$table = $search['tbl'];
		} else {
			$table = 'news_unpublish';
		}
		$this->_modelQuery = 'select count(1) as cnt from ' . $table . ' ' . $where_condition;
		$this->query($this->_modelQuery);
		return $this->single();
	}

	protected function getNewsList($order, $offset, $limit, $search = array()) {
		$where_condition = array();
		if (isset($search['publish_status'])) {
			$where_condition[] = ' nu.publish = "' . $search['publish_status'] . '"';
		}
		if (isset($search['autono']) && $search['autono'] != '') {
			$where_condition[] .= ' nu.autono = "' . $search['autono'] . '"';
		} else {
			if (isset($search['category_id']) && $search['category_id'] != '') {
				$where_condition[] .= ' nu.category_id = "' . $search['category_id'] . '"';
			}
			if (isset($search['subcategory_id']) && $search['subcategory_id'] != '') {
				$where_condition[] .= ' nu.sub_category_id = "' . $search['subcategory_id'] . '"';
			}
			if (isset($search['exclude_subcategory_id']) && $search['exclude_subcategory_id'] != '') {
				$where_condition[] .= ' nu.sub_category_id NOT IN (' . implode(',', $search['exclude_subcategory_id']) . ')';
			}
			if (isset($search['exclude_autono'])) {
				if (is_array($search['exclude_autono'])) {
					$where_condition[] .= ' nu.autono NOT IN (' . implode(",", $search['exclude_autono']) . ')';
				} else if ($search['exclude_autono'] != '') {
					$where_condition[] .= ' nu.autono != "' . $search['exclude_autono'] . '"';
				}
			}
			if (isset($search['date_range']) && !empty($search['date_range'][0]) && !empty($search['date_range'][1])) {
				$where_condition[] .= ' nu.modified_date BETWEEN "' . $search['date_range'][0] . '" and "' . $search['date_range'][1] . '"';
			}
			if (isset($search['headline']) && $search['headline'] != '') {
				$where_condition[] .= ' nu.headline like "%' . $search['headline'] . '%"';
			}
		}
		if (!empty($where_condition)) {
			$where_condition = 'where ' . implode(' and ', $where_condition);
		}
		if (isset($search['tbl'])) {
			$table = $search['tbl'];
		} else {
			$table = 'news_unpublish';
		}
		$this->_modelQuery = 'select nu.publish_date as modified_date, nu.autono, nu.headline, nu.category_id, nu.sub_category_id, nu.summary, nu.source_id, ib.image_id,ib.image_name,ib.image_keywords,ib.image_name,ib.image_1600,ib.image_1280,ib.image_615,ib.image_300,ib.image_100,ib.image_77,ib.image_courtesy  from ' . $table . ' nu LEFT JOIN image_bank ib ON ib.image_id = nu.image_id ' . $where_condition . ' order by nu.publish_date ' . $order . ' limit ' . $offset . ',' . $limit . '';
		$this->query($this->_modelQuery);

		return $this->resultset();
	}

	protected function getNewsDetails($order, $offset, $limit, $search = array(), $return_type = 'json') {
		$total = $this->getNewsCount($search);
		$userList = $this->getNewsList($order, $offset, $limit, $search);
		$category = $this->getNewsCategory();
		$news_source = $this->getNewsSource();
		$prev_cat = NULL;
		foreach ($userList as $key => $value) {
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$userList[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$userList[$key]['disp_date'] = date('M d, Y H:iA', strtotime($value['modified_date']));

			$userList[$key]['ago_date'] = $this->_commonFunction->humanTiming(strtotime($value['modified_date']));
			$userList[$key]['category_name'] = $category[$value['category_id']];
			$userList[$key]['category_url'] = _CONST_WEB_URL . '/' . $this->_commonFunction->sanitizeString($category[$value['category_id']]);

			if ($value['sub_category_id'] == 12 && $value['category_id'] == 1) {
				$userList[$key]['sub_category_name'] = 'Hot Cake';
			} else {
				$userList[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
			}
			$userList[$key]['news_source'] = $news_source[$value['source_id']];
			$userList[$key]['news_url'] = _CONST_WEB_URL . '/' . $value['autono'] . '/' . $this->_commonFunction->sanitizeString($value['headline']);
		}
		if ($return_type == 'json') {
			return json_encode(array("total" => (int) $total['cnt'], "rows" => $userList));
		} else {
			return array("total" => (int) $total['cnt'], "rows" => $userList);
		}

	}

	protected function getRankedStoryDetails($type, $return_type = 'json', $limit = '') {
		if ($limit == '') {
			$this->_modelQuery = 'select nup.publish_date as modified_date, nup.autono, nup.headline, nup.category_id, nup.sub_category_id, nr.rank, nr.caption, ib.image_id,ib.image_name,ib.image_keywords,ib.image_name,ib.image_1600,ib.image_1280,ib.image_615,ib.image_300,ib.image_100,ib.image_77,ib.image_courtesy  from news_unpublish nup INNER JOIN news_rank nr ON nr.autono = nup.autono INNER JOIN image_bank ib ON ib.image_id = nup.image_id where nr.type="' . $type . '" order by nr.rank ';
		} else {
			$this->_modelQuery = 'select nup.publish_date as modified_date, nup.autono, nup.headline, nup.category_id, nup.sub_category_id, nr.rank, nr.caption, ib.image_id,ib.image_name,ib.image_keywords,ib.image_name,ib.image_1600,ib.image_1280,ib.image_615,ib.image_300,ib.image_100,ib.image_77,ib.image_courtesy  from news_unpublish nup INNER JOIN news_rank nr ON nr.autono = nup.autono INNER JOIN image_bank ib ON ib.image_id = nup.image_id where nr.type="' . $type . '" order by nr.rank limit ' . $limit;
		}

		$this->query($this->_modelQuery);
		$this->_queryResult = $this->resultset();
		$total = count($this->_queryResult);
		$category = $this->getNewsCategory();
		$prev_cat = NULL;
		foreach ($this->_queryResult as $key => $value) {
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$this->_queryResult[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$this->_queryResult[$key]['disp_date'] = date('M d, Y H:iA', strtotime($value['modified_date']));
			$this->_queryResult[$key]['ago_date'] = $this->_commonFunction->humanTiming(strtotime($value['modified_date']));
			$this->_queryResult[$key]['category_name'] = $category[$value['category_id']];
			$this->_queryResult[$key]['category_url'] = _CONST_WEB_URL . '/' . $this->_commonFunction->sanitizeString($category[$value['category_id']]);
			if ($this->_queryResult[$key]['caption'] == null) {
				$this->_queryResult[$key]['caption'] = '';
			}
			if ($value['sub_category_id'] == 12 && $value['category_id'] == 1) {
				$this->_queryResult[$key]['sub_category_name'] = 'Hot Cake';
			} else {
				$this->_queryResult[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
			}
			$this->_queryResult[$key]['news_url'] = _CONST_WEB_URL . '/' . $value['autono'] . '/' . $this->_commonFunction->sanitizeString($value['headline']);
		}
		if ($return_type == 'json') {
			return json_encode(array("total" => (int) $total, "rows" => $this->_queryResult));
		} else {
			return array("total" => (int) $total, "rows" => $this->_queryResult);
		}

	}

	protected function getHomePageDetails() {
		$result['cover-story-details'] = $this->getRankedStoryDetails('cover story', 'array', 4)['rows'];
		$result['hot-of-the-press'] = $this->getNewsDetails('desc', 0, 15, array('publish_status' => 1), 'array')['rows'];
		$result['forecaster'] = $this->getNewsDetails('desc', 0, 1, array('publish_status' => 1, 'category_id' => 12), 'array')['rows'];
		$result['chart-of-the-day'] = $this->getNewsDetails('desc', 0, 1, array('publish_status' => 1, 'category_id' => 11), 'array')['rows'];
		$result['market-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '1', 'exclude_sub_category_id' => array('16', '17')), 'array')['rows'];
		$result['corporate-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '2'), 'array')['rows'];
		$result['news-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '3'), 'array')['rows'];
		$result['investing-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '4'), 'array')['rows'];
		//$result['earnings-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '5'), 'array')['rows'];
		$result['budget-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '6'), 'array')['rows'];
		$result['economy-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '7'), 'array')['rows'];
		/*echo '<pre>' . print_r($result) . '</pre>';
		die();*/
		return $result;
	}

	protected function getNewsWidgetDetails() {
		$result['top_10'] = $this->getRankedStoryDetails('cover story', 'array', 5)['rows'];
		$result['latest'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1), 'array_CONST_WEB_URL')['rows'];
		return $result;
	}

	protected function getCategoryDetails($order, $offset, $limit, $search = array(), $return_type = 'json') {
		$userList = $this->getNewsList($order, $offset, $limit, $search);
		$category = $this->getNewsCategory();
		$news_source = $this->getNewsSource();
		$prev_cat = NULL;
		foreach ($userList as $key => $value) {
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$userList[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$userList[$key]['disp_date'] = date('M d, Y H:iA', strtotime($value['modified_date']));
			$userList[$key]['ago_date'] = $this->_commonFunction->humanTiming(strtotime($value['modified_date']));
			$userList[$key]['category_name'] = $category[$value['category_id']];
			$userList[$key]['category_url'] = _CONST_WEB_URL . '/' . $this->_commonFunction->sanitizeString($category[$value['category_id']]);
			if ($value['sub_category_id'] == 12 && $value['category_id'] == 1) {
				$userList[$key]['sub_category_name'] = 'Hot Cake';
			} else {
				$userList[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
			}
			$userList[$key]['news_source'] = $news_source[$value['source_id']];
			$userList[$key]['news_url'] = _CONST_WEB_URL . '/' . $value['autono'] . '/' . $this->_commonFunction->sanitizeString($value['headline']);
		}
		if ($return_type == 'json') {
			$result['categoryDetails'] = json_encode(array("total" => (int) $total['cnt'], "rows" => $userList));
		} else {
			$result['categoryDetails'] = array("rows" => $userList);
		}
		return $result;
	}

	protected function getAllRankedStoryDetails($type, $return_type = 'json', $for = NULL) {
		$this->_modelQuery = 'select nup.*, nr.rank, nr.caption, ib.image_id,ib.image_name,ib.image_keywords,ib.image_name,ib.image_1600,ib.image_1280,ib.image_615,ib.image_300,ib.image_100,ib.image_77,ib.image_courtesy  from news_unpublish nup INNER JOIN news_rank nr ON nr.autono = nup.autono INNER JOIN image_bank ib ON ib.image_id = nup.image_id where nr.type="' . $type . '" order by nr.rank';

		$this->query($this->_modelQuery);
		$this->_queryResult = $this->resultset();
		$total = count($this->_queryResult);
		$category = $this->getNewsCategory();
		$news_source = $this->getNewsSource();
		$prev_cat = NULL;
		$last_related_autono = array();
		foreach ($this->_queryResult as $key => $value) {
			if ($for == 'article') {
				$attachments = array();
				$this->_modelQuery = 'select file_path from news_attachments na JOIN attachments attach ON na.attachment_id = attach.attachment_id WHERE article_id = :article_id';
				$this->query($this->_modelQuery);
				$this->bindByValue('article_id', $value['autono']);
				$news_attachments = $this->resultset();
				$attachments = array();
				foreach ($news_attachments as $na_key => $na_value) {
					$attachments[] = $na_value['file_path'];
				}
				$this->_queryResult[$key]['attachments'] = $attachments;
			}
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$this->_queryResult[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$this->_queryResult[$key]['disp_date'] = date('M d, Y H:iA', strtotime($value['modified_date']));
			$this->_queryResult[$key]['ago_date'] = $this->_commonFunction->humanTiming(strtotime($value['modified_date']));
			$this->_queryResult[$key]['category_name'] = $category[$value['category_id']];
			$this->_queryResult[$key]['news_source_name'] = $news_source[$value['source_id']];
			$this->_queryResult[$key]['category_url'] = _CONST_WEB_URL . '/' . $this->_commonFunction->sanitizeString($category[$value['category_id']]);
			if ($this->_queryResult[$key]['caption'] == null) {
				$this->_queryResult[$key]['caption'] = '';
			}
			if ($value['sub_category_id'] == 12 && $value['category_id'] == 1) {
				$this->_queryResult[$key]['sub_category_name'] = 'Hot Cake';
			} else {
				$this->_queryResult[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
			}
			$this->_queryResult[$key]['news_url'] = _CONST_WEB_URL . '/' . $value['autono'] . '/' . $this->_commonFunction->sanitizeString($value['headline']);
			$last_related_autono[] = $value['autono'];

			$this->_queryResult[$key]['related-news'] = $this->getRelatedNewsWidgetDetails($last_related_autono, $value['related_story'], $value['category_id']);
			if ($this->_queryResult[$key]['related-news']['left-col']['autono'] != '') {
				$last_related_autono[] = $this->_queryResult[$key]['related-news']['left-col']['autono'];
			}
			if ($this->_queryResult[$key]['related-news']['right-col']['autono'] != '') {
				$last_related_autono[] = $this->_queryResult[$key]['related-news']['right-col']['autono'];
			}

		}
		if ($return_type == 'json') {
			return json_encode(array("total" => (int) $total, "rows" => $this->_queryResult));
		} else {
			return array("total" => (int) $total, "rows" => $this->_queryResult);
		}

	}

	protected function getArticleCategoryStoryDetails($cat_id, $return_type = 'json', $for = NULL) {
		$this->_modelQuery = 'select nup.*, ib.image_id,ib.image_name,ib.image_keywords,ib.image_name,ib.image_1600,ib.image_1280,ib.image_615,ib.image_300,ib.image_100,ib.image_77,ib.image_courtesy  from news_unpublish nup INNER JOIN image_bank ib ON ib.image_id = nup.image_id where nup.publish="1" and nup.category_id="' . $cat_id . '" order by nup.publish_date desc limit 15';

		$this->query($this->_modelQuery);
		$this->_queryResult = $this->resultset();
		$total = count($this->_queryResult);
		$category = $this->getNewsCategory();
		$news_source = $this->getNewsSource();
		$prev_cat = NULL;
		$last_related_autono = array();
		foreach ($this->_queryResult as $key => $value) {
			$last_related_autono[] = $value['autono'];
		}
		reset($this->_queryResult);
		foreach ($this->_queryResult as $key => $value) {
			if ($for == 'article') {
				$attachments = array();
				$this->_modelQuery = 'select file_path from news_attachments na JOIN attachments attach ON na.attachment_id = attach.attachment_id WHERE article_id = :article_id';
				$this->query($this->_modelQuery);
				$this->bindByValue('article_id', $value['autono']);
				$news_attachments = $this->resultset();
				$attachments = array();
				foreach ($news_attachments as $na_key => $na_value) {
					$attachments[] = $na_value['file_path'];
				}
				$this->_queryResult[$key]['attachments'] = $attachments;
			}
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$this->_queryResult[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$this->_queryResult[$key]['disp_date'] = date('M d, Y H:iA', strtotime($value['modified_date']));
			$this->_queryResult[$key]['ago_date'] = $this->_commonFunction->humanTiming(strtotime($value['modified_date']));
			$this->_queryResult[$key]['category_name'] = $category[$value['category_id']];
			$this->_queryResult[$key]['news_source_name'] = $news_source[$value['source_id']];
			$this->_queryResult[$key]['category_url'] = _CONST_WEB_URL . '/' . $this->_commonFunction->sanitizeString($category[$value['category_id']]);
			if ($this->_queryResult[$key]['caption'] == null) {
				$this->_queryResult[$key]['caption'] = '';
			}
			if ($value['sub_category_id'] == 12 && $value['category_id'] == 1) {
				$this->_queryResult[$key]['sub_category_name'] = 'Hot Cake';
			} else {
				$this->_queryResult[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
			}
			$this->_queryResult[$key]['news_url'] = _CONST_WEB_URL . '/' . $value['autono'] . '/' . $this->_commonFunction->sanitizeString($value['headline']);

			$this->_queryResult[$key]['related-news'] = $this->getRelatedNewsWidgetDetails($last_related_autono, $value['related_story'], $value['category_id']);
			if ($this->_queryResult[$key]['related-news']['left-col']['autono'] != '') {
				$last_related_autono[] = $this->_queryResult[$key]['related-news']['left-col']['autono'];
			}
			if ($this->_queryResult[$key]['related-news']['right-col']['autono'] != '') {
				$last_related_autono[] = $this->_queryResult[$key]['related-news']['right-col']['autono'];
			}

		}
		if ($return_type == 'json') {
			return json_encode(array("total" => (int) $total, "rows" => $this->_queryResult));
		} else {
			return array("total" => (int) $total, "rows" => $this->_queryResult);
		}

	}

	private function getCoverStoryAutonos($type) {
		$this->_modelQuery = 'select nup.autono from news_unpublish nup INNER JOIN news_rank nr ON nr.autono = nup.autono where nr.type="' . $type . '" order by nr.rank';
		$this->query($this->_modelQuery);
		$this->_queryResult = $this->resultset();
		$related_autono = array();
		$related_autono[] = NULL;
		foreach ($this->_queryResult as $key => $value) {
			$related_autono[] = $value['autono'];
		}
		return $related_autono;
	}

	protected function getArticleById($autono) {
		$news_source = $this->getNewsSource();
		$result['article-details'] = $this->getArticleDetails(array('articleId' => $autono));
		$ranked_story = $this->getCoverStoryAutonos('cover story');
		$result['article-details']['news_url'] = _CONST_WEB_URL . '/' . $result['article-details']['articleId'] . '/' . $this->_commonFunction->sanitizeString($result['article-details']['heading']);
		$result['article-details']['news_source_name'] = $news_source[$result['article-details']['news_source']];
		$result['related-news'] = $this->getRelatedNewsWidgetDetails($result['article-details']['articleId'], $result['article-details']['related_story'], $result['article-details']['news_category']);
		if (in_array($autono, $ranked_story)) {
			$result['suggested-stories'] = $this->getAllRankedStoryDetails('cover story', 'array', 'article')['rows'];
		} else {
			$result['suggested-stories'] = $this->getArticleCategoryStoryDetails($result['article-details']['news_category'], 'array', 'article')['rows'];
		}

		return $result;
	}

	protected function getRelatedNewsWidgetDetails($articleIds, $related_autono, $category_id) {
		$search_params['publish_status'] = 1;
		$search_params['category_id'] = $category_id;
		if (is_array($articleIds)) {
			$search_params['exclude_autono'] = $articleIds;
		} else {
			$search_params['exclude_autono'][] = $articleIds;
		}
		if ($related_autono != '') {
			$search_params['exclude_autono'][] = $related_autono;
		}

		$result['left-col'] = $this->getNewsDetails('desc', 0, 1, $search_params, 'array')['rows'][0];

		unset($search_params['category_id']);
		if ($related_autono == '' || $related_autono == NULL || $related_autono == '0') {
			if ($result['left-col']['autono'] != '') {
				$search_params['exclude_autono'][] = $result['left-col']['autono'];
			}
		} else {
			unset($search_params['exclude_autono']);
			$search_params['autono'] = $related_autono;
		}

		$result['right-col'] = $this->getNewsDetails('desc', 0, 1, $search_params, 'array')['rows'][0];
		return $result;
	}
}
?>
