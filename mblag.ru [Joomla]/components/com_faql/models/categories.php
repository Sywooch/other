<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

class faqlsModelCategories extends JModel
{
	var $_data = null;
	var $_total = null;

	function getItems()
	{
		if (empty($this->_data))
		{
			$db = JFactory::getDBO();
			$query = 'SELECT * FROM #__categories WHERE extension = "com_faql" AND published = 1 ORDER BY lft';
			$db->setQuery($query);
			$this->_data = $db->loadObjectList();
			if ($db->getErrorNum()) {
				$error = JError::raiseWarning(500, $db->stderr());
				return false;
			}

			$totalquest = 0;
			$totaltoday = 0;
			$totalanswer = 0;
			$tanswtoday = 0;
			$total = 0;
			$ttoday = 0;
			$datetoday = date('Y-m-d');
			for($i = 0; $i < count($this->_data); $i++) {
				// Convert the params field to a registry.
				$catpar = new JRegistry;
				$catpar->loadJSON($this->_data[$i]->params);
				$this->_data[$i]->params = $catpar;
				
				// questions and answers
				$this->_data[$i]->numquestion = 0;
				$this->_data[$i]->numanswer = 0;
				$this->_data[$i]->catansw_t = 0;
				$this->_data[$i]->catquest_t = 0;
				
				$query = 'SELECT id, state, created, created_ans FROM #__faql WHERE catid = '.$this->_data[$i]->id.' AND published = 1';
				$db->setQuery($query);
				$numbquest = $db->loadObjectList();
				if ($db->getErrorNum()) {
					$error = JError::raiseWarning(500, $db->stderr());
					return false;
				}
				
				$total = 0;
				$ttoday = 0;
				if ($numbquest) {
					$this->_data[$i]->numquestion = count($numbquest);  // questions in category
					
					foreach ( $numbquest as $row ) {
						if ($row->state == 2) {
							$total++;
							$this->_data[$i]->numanswer++; // answers in category
							if (strcmp(substr($row->created_ans, 0, 10), $datetoday) == 0) {
								$ttoday++;
								$this->_data[$i]->catansw_t++; // answers in category today
							}
						}
						if (strcmp(substr($row->created, 0, 10), $datetoday) == 0) {
								$this->_data[$i]->catquest_t++;  // questions in category today
							}
						if (strcmp(substr($row->created, 0, 10), $datetoday) == 0) $totaltoday++;
					}
				}
				else $this->_data[$i]->numquestion = 0;
				
				$totalquest += $this->_data[$i]->numquestion;
				$totalanswer += $total;
				$tanswtoday += $ttoday;
			}
			$this->_total->quest = $totalquest; // questions in DB
			$this->_total->questtoday = $totaltoday;  // questions in DB today
			$this->_total->answer = $totalanswer; // answers in DB
			$this->_total->answertoday = $tanswtoday; // answers in DB today
		}
		
		return $this->_data;
	}

	function getTotal()
	{
		return $this->_total;
	}
}
?>
