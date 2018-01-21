<?php
ignore_user_abort();
class DbController extends Site_Controller
{
	const EXEC_TIMEOUT = 120;
	
	public function actionDefault()
	{
		$this->actionImportNomenclature();
		$this->actionImportGoodsToOrder();
		$this->actionImportRequestsToOrder();
		$this->actionImportGoodsToOrderUpdate();
		$this->actionImportStores();
		$this->actionImportRemains();
		$this->actionImportSimilar();
	}
	
	public function actionImportN()
	{
		$this->actionImportNomenclature();
	}
	
	public function actionSR()
	{
		$this->actionImportStores();
		$this->actionImportRemains();
	}
	
	public function actionImportSimilar()
	{
		$files = $this->getFiles('similar', ROOT_PATH.'console/data/');
		$similar_f = $this->getProcessFile('similar', $files);
		if (empty($similar_f)) {
			echo "No similar for processing.\n";
		} else {
			$log_id = $this->model('logs')->Save(
				'import_logs',
				array(
					'status' => 'start',
					'stime' => date('Y-m-d H:i:s'),
					'major_id' => $similar_f['major'],
					'minor_id' => $similar_f['minor'],
					'type' => 'similar',
					'source' => 'main'
				)
			);
			if($similar_f['minor'] == '000') {
				$this->model('db')->truncate('similar_goods');
			}
			if (!$this->model('db')->importSimilar($similar_f['path'])) {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'fail',
						'etime' => date('Y-m-d H:i:s'),
						'error' => $this->model('db')->error
					),
					$log_id
				);
				echo $this->model('db')->error."\n";
			} else {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'success',
						'etime' => date('Y-m-d H:i:s')
					),
					$log_id
				);
				echo "End processing similar.\n";
			}
		}
	}
	
	public function actionImportNomenclature()
	{
		$files = $this->getFiles('nomenclature', ROOT_PATH.'console/data/');
		$nomenclature_f = $this->getProcessFile('nomenclature', $files);
		if(empty($nomenclature_f)){
			echo "No nomenclature for processing.\n";
		} else {
			$log_id = $this->model('logs')->Save(
				'import_logs',
				array(
					'status' => 'start',
					'stime' => date('Y-m-d H:i:s'),
					'major_id' => $nomenclature_f['major'],
					'minor_id' => $nomenclature_f['minor'],
					'type' => 'nomenclature',
					'source' => 'main'
				)
			);
			if($nomenclature_f['minor'] == '000') {
// 				$this->model('db')->truncate('factories');
// 				$this->model('db')->truncate('collections');
				//$this->model('db')->truncate('goods');
                $this->model('db')->flushGoods();
// 				$this->model('db')->truncate('units');
 				$this->model('db')->truncate('prices');
				$this->model('db')->truncate('prices2goods');
			}
			if (!$this->model('db')->importGoods($nomenclature_f['path'])) {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'fail',
						'etime' => date('Y-m-d H:i:s'),
						'error' => $this->model('db')->error
					),
					$log_id
				);
				echo $this->model('db')->error."\n";
			} else {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'success',
						'etime' => date('Y-m-d H:i:s')
					),
					$log_id
				);
				echo "End processing nomenclatures.\n";
			}

		}
	}

	public function actionImportGoodsToOrder()
	{
		$files = $this->getFiles('goodstoorder', ROOT_PATH.'console/data/');
		$goods_f = $this->getProcessFile('goodstoorder', $files);
		if(empty($goods_f)){
			echo "No goods to order for processing.\n";
		} else {
			$log_id = $this->model('logs')->Save(
				'import_logs',
				array(
					'status' => 'start',
					'stime' => date('Y-m-d H:i:s'),
					'major_id' => $goods_f['major'],
					'minor_id' => $goods_f['minor'],
					'type' => 'goodstoorder',
					'source' => 'main'
				)
			);
			if($goods_f['minor'] == '000') {
				$this->model('db')->flushGoods_to_order();
			}
			if (!$this->model('db')->importGoods_to_order($goods_f['path'])) {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'fail',
						'etime' => date('Y-m-d H:i:s'),
						'error' => $this->model('db')->error
					),
					$log_id
				);
				echo $this->model('db')->error."\n";
			} else {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'success',
						'etime' => date('Y-m-d H:i:s')
					),
					$log_id
				);
				echo "End processing goodstoorder.\n";
			}

		}
	}

	public function actionImportRequestsToOrder()
	{
		$files = $this->getFiles('requeststoorder', ROOT_PATH.'console/data/');
		$goods_f = $this->getProcessFile('requeststoorder', $files);
		if(empty($goods_f)){
			echo "No goods to order for processing.\n";
		} else {
            /** @var DbModel $db */
            $db = $this->model('db');
			$log_id = $this->model('logs')->Save(
				'import_logs',
				array(
					'status' => 'start',
					'stime' => date('Y-m-d H:i:s'),
					'major_id' => $goods_f['major'],
					'minor_id' => $goods_f['minor'],
					'type' => 'requeststoorder',
					'source' => 'main'
				)
			);

			if (!$db->importRequestsToOrder($goods_f['path'])) {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'fail',
						'etime' => date('Y-m-d H:i:s'),
                        'type' => 'requeststoorder',
                        'error' => $db->error,
					),
					$log_id
				);
				echo $db->error."\n";
			} else {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'success',
                        'type' => 'requeststoorder',
                        'etime' => date('Y-m-d H:i:s')
					),
					$log_id
				);
				echo "End processing requeststoorder.\n";
			}

		}
	}

	public function actionImportGoodsToOrderUpdate()
	{
		$files = $this->getFiles('goodstoorderupdate', ROOT_PATH.'console/data/');
		$goods_f = $this->getProcessFile('goodstoorderupdate', $files);
		if(empty($goods_f)){
			echo "No goods to order for processing.\n";
		} else {
            /** @var DbModel $db */
            $db = $this->model('db');
			$log_id = $this->model('logs')->Save(
				'import_logs',
				array(
					'status' => 'start',
					'stime' => date('Y-m-d H:i:s'),
					'major_id' => $goods_f['major'],
					'minor_id' => $goods_f['minor'],
					'type' => 'goodstoorderupdate',
					'source' => 'main'
				)
			);
			if (!$db->importGoodsToOrderUpdate($goods_f['path'])) {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'fail',
						'etime' => date('Y-m-d H:i:s'),
                        'type' => 'goodstoorderupdate',
                        'error' => $db->error
					),
					$log_id
				);
				echo $db->error."\n";
			} else {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'success',
                        'type' => 'goodstoorderupdate',
                        'etime' => date('Y-m-d H:i:s')
					),
					$log_id
				);
				echo "End processing goodstoorderupdate.\n";
			}

		}
	}

	public function actionImportStores()
	{
		$files = $this->getFiles('store', ROOT_PATH.'console/data/');
		$store_f = $this->getProcessFile('store', $files);
		if(empty($store_f)){
			echo "No warehouses for processing.\n";
		} else {
			$log_id = $this->model('logs')->Save(
				'import_logs',
				array(
					'status' => 'start',
					'stime' => date('Y-m-d H:i:s'),
					'major_id' => $store_f['major'],
					'minor_id' => $store_f['minor'],
					'type' => 'store',
					'source' => 'main'
				)
			);
			if($store_f['minor'] == '000') {
				$this->model('db')->truncate('stores');
			}
			if (!$this->model('db')->importStores($store_f['path'])) {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'fail',
						'etime' => date('Y-m-d H:i:s'),
						'error' => $this->model('db')->error
					),
					$log_id
				);
				echo $this->model('db')->error."\n";
			} else {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'success',
						'etime' => date('Y-m-d H:i:s')
					),
					$log_id
				);
				echo "End processing warehouses.\n";
			}
		}
	}
	
	public function actionImportRemains()
	{
		$files = $this->getFiles('remains', ROOT_PATH.'console/data/');
		$remains_f = $this->getProcessFile('remains', $files);
		if(empty($remains_f)){
			echo "No remains processing.\n";
		} else {
			$log_id = $this->model('logs')->Save(
				'import_logs',
				array(
					'status' => 'start',
					'stime' => date('Y-m-d H:i:s'),
					'major_id' => $remains_f['major'],
					'minor_id' => $remains_f['minor'],
					'type' => 'remains',
					'source' => 'main'
				)
			);
			if($remains_f['minor'] == '000') {
				$this->model('db')->truncate('remains');
			}
			if (!$this->model('db')->importRemains($remains_f['path'])) {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'fail',
						'etime' => date('Y-m-d H:i:s'),
						'error' => $this->model('db')->error
					),
					$log_id
				);
				echo $this->model('db')->error."\n";
			} else {
				$this->model('logs')->Save(
					'import_logs',
					array(
						'status' => 'success',
						'etime' => date('Y-m-d H:i:s')
					),
					$log_id
				);
				echo "End of processing remains.\n";
			}
		}
				
	}
	
    public function actionImportRequestsFull(){
        $not_recalc = $this->actionImportRequests();
        $this->actionImportRequestsGoods($not_recalc);
    }
    public function actionImportRequests(){
        $files = $this->getFiles('requests', ROOT_PATH.'console/data/');
        $requests_f = $this->getProcessFile('requests', $files);
        if(empty($requests_f)){
            echo "No requests processing.\n";
        } else {
            $log_id = $this->model('logs')->Save(
                'import_logs',
                array(
                    'status' => 'start',
                    'stime' => date('Y-m-d H:i:s'),
                    'major_id' => $requests_f['major'],
                    'minor_id' => $requests_f['minor'],
                    'type' => 'requests',
                    'source' => 'main'
                )
            );
            $import_result = $this->model('db')->importRequests($requests_f['path']);
            if (!$import_result) {
                $this->model('logs')->Save(
                    'import_logs',
                    array(
                        'status' => 'fail',
                        'etime' => date('Y-m-d H:i:s'),
                        'error' => $this->model('db')->error
                    ),
                    $log_id
                );
                echo $this->model('db')->error."\n";
                return false;
            } else {
                $this->model('logs')->Save(
                    'import_logs',
                    array(
                        'status' => 'success',
                        'etime' => date('Y-m-d H:i:s')
                    ),
                    $log_id
                );
                echo "End of processing requests.\n";
                return $import_result;
            }
        }
    }
    public function actionImportRequestsGoods($not_recalc = 0){
        $files = $this->getFiles('requests_goods', ROOT_PATH.'console/data/');
        $requests_goods_f = $this->getProcessFile('requests_goods', $files);
        if(empty($requests_goods_f)){
            echo "No requests_goods processing.\n";
        } else {
            $log_id = $this->model('logs')->Save(
                'import_logs',
                array(
                    'status' => 'start',
                    'stime' => date('Y-m-d H:i:s'),
                    'major_id' => $requests_goods_f['major'],
                    'minor_id' => $requests_goods_f['minor'],
                    'type' => 'requests_goods',
                    'source' => 'main'
                )
            );
            if (!$this->model('db')->importRequestsGoods($requests_goods_f['path'], $not_recalc)) {
                $this->model('logs')->Save(
                    'import_logs',
                    array(
                        'status' => 'fail',
                        'etime' => date('Y-m-d H:i:s'),
                        'error' => $this->model('db')->error
                    ),
                    $log_id
                );
                echo $this->model('db')->error."\n";
            } else {
                $this->model('logs')->Save(
                    'import_logs',
                    array(
                        'status' => 'success',
                        'etime' => date('Y-m-d H:i:s')
                    ),
                    $log_id
                );
                echo "End of processing requests_goods.\n";
            }
        }
    }
    
    public function actionImportBills(){
        $files = $this->getFiles('bills', ROOT_PATH.'console/data/');
        $bill_f = $this->getProcessFile('bills', $files);
        if(empty($bill_f)){
            echo "No bills processing.\n";
        } else {
            $log_id = $this->model('logs')->Save(
                'import_logs',
                array(
                    'status' => 'start',
                    'stime' => date('Y-m-d H:i:s'),
                    'major_id' => $bill_f['major'],
                    'minor_id' => $bill_f['minor'],
                    'type' => 'bills',
                    'source' => 'main'
                )
            );
            if (!$this->model('db')->importBills($bill_f['path'])) {
                $this->model('logs')->Save(
                    'import_logs',
                    array(
                        'status' => 'fail',
                        'etime' => date('Y-m-d H:i:s'),
                        'error' => $this->model('db')->error
                    ),
                    $log_id
                );
                echo $this->model('db')->error."\n";
            } else {
                $this->model('logs')->Save(
                    'import_logs',
                    array(
                        'status' => 'success',
                        'etime' => date('Y-m-d H:i:s')
                    ),
                    $log_id
                );
                echo "End of processing bills.\n";
            }
        }
    }
    
	public function getProcessFile($type, $files, $source = 'main')
	{
		if (empty($files)) return;
		foreach ($files as $major) {
			if (empty($major)) return;
			foreach ($major as $file) {
				$data = $this->model('logs')->GetByCond(
					'import_logs',
					$this->model('logs')->getFieldsNames('import_logs', 'list'),
					array('where' => array(
						'type' => $type,
						'source' => $source,
						'major_id' => $file['major'],
						'minor_id' => $file['minor']
					)), 1
				);
            }
				if (empty($data['status'])) $data['status'] = null;
				switch ($data['status']) {
					//если есть стартовавшие и существуют менее EXEC_TIMEOUT секунд, то ждем.
					case 'start':
						if (strtotime($data['stime']) < (time() - self::EXEC_TIMEOUT)) {
							$this->model('logs')->Save(
								'import_logs',
								array(
									'status' => 'fail',
									'etime' => date('Y-m-d H:i:s'),
									'error' => 'Interrupted by a timeout '.self::EXEC_TIMEOUT.' с.'
								),
								$data['id']
							); //если нет, закрываем насильно
							echo "Start treatment $type #{$file['major']}-{$file['minor']}, as past treatment was interrupted by a timeout...\n";
							return $file;
						}
						else {
							echo "Processing $type #{$file['major']}-{$file['minor']}...\n";
						}
					break;
					//если все хорошо, то идем дальше
					case 'success':
						echo "$type #{$file['major']}-{$file['minor']} already been processed.\n";
						continue;
					break;
					//если файл не был загружен, пробуем загрузить снова
					case 'fail':
						echo "Start treatment $type #{$file['major']}-{$file['minor']}, as past treatment was interrupted...\n";
						return $file;
					break;
					//если файл текущий
					default:
						echo "Start treatment $type #{$file['major']}-{$file['minor']}...\n";
						return $file;
					break;
				}
			//}
		}
	}

    
	public function getFiles($type, $dir) 
	{
		switch ($type) {
			case 'nomenclature':
				$fileName = 'GoodsUp';
			break;
			case 'goodstoorder':
				$fileName = 'TovarZak';
				break;
			case 'requeststoorder':
				$fileName = 'ReqOrder';
				break;
			case 'goodstoorderupdate':
				$fileName = 'ReqOrderGoods';
				break;
			case 'remains':
				$fileName = 'RestsUp';
			break;
			case 'store':
				$fileName = 'WarehousesUp';
			break;
			case 'similar':
				$fileName = 'LinkUp';
			break;
            case 'requests':
                $fileName = 'Zak';
            break;
            case 'requests_goods':
                $fileName = 'ZakLst';
            break;
            case 'bills':
                $fileName = 'ZakNakl';
            break;
			default:
				return false;
			break;
		}
		$files_raw = scandir($dir, 1);
		$files = array();
		for ($i = 0, $maxi = count($files_raw); $i < $maxi; $i++) {
			$matches = array();
			if (preg_match("/^$fileName-(\d+)-(\d+).csv$/", $files_raw[$i], $matches)) {
				$files[intval($matches[1])][intval($matches[2])] = array(
					"path"  => $dir.$matches[0],
					"major" => $matches[1],
					"minor" => $matches[2]
				);
			}
		}
		foreach ($files as &$file) {
			ksort($file, SORT_NUMERIC);
		}
		ksort($files, SORT_NUMERIC);
		end($files);
		return array(key($files) => current($files));
	}
}