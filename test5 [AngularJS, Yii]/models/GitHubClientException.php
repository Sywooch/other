<?php
namespace app\models;

use Yii;
use yii\base\Model;

class GitHubClientException extends Model
{
	const CLASS_NOT_FOUND = 1;
	const PAGE_INVALID = 2;
	const PAGE_SIZE_INVALID = 3;
	const INVALID_HTTP_CODE = 4;
	const INVALID_RESULT = 5;
}
