<?php
function js($dirname, $file_name, $version=1.0)
{
	echo '<script type="text/javascript" src="'.$dirname.'/js/'.$file_name.'.js?v='.$version.'"></script>';
}

function css($dirname, $file_name, $version=1.0)
{
	echo '<link rel="stylesheet" type="text/css" href="'.$dirname.'/css/'.$file_name.'.css?v='.$version.'"/>';
}

function pr($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function redirectAction($uri = '', $method = 'location', $http_response_code = 302)
{
	if (!preg_match('#^https?://#i', $uri)) {
		$uri = base_url($uri);
	}

	switch($method) {
		case 'refresh' :
			header("Refresh:0;url=".$uri);
			break;
		default :
			header("Location: ".$uri, TRUE, $http_response_code);
			break;
	}
	exit;
}

/**
 * 
 * */
function alert_message()
{
    $CI = & get_instance();
    $CI->load->library('session');
    $alert_msg = empty($CI->session->flashdata('error')) ? $CI->session->flashdata('success') : $CI->session->flashdata('error');
    if (!empty($alert_msg)) {
        return '<script>alert("'.$alert_msg.'");</script>';
    }
}

/**
 * 发送邮件
 * @param string $mail_to
 * @param string $mail_subject
 * @param string $mail_message
 * @param string $mail_from
 * @param string $mail_name
 */
function sendEmails($mail_to, $mail_subject, $mail_message, $mail_from, $mail_name='')
{
	$CI = & get_instance();
	$CI->load->library('email');
	$config['protocol'] = 'sendmail';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = TRUE;
	$config['mailtype'] = 'html';
	$CI->email->initialize($config);

	$CI->email->from($mail_from, $mail_name);
	$CI->email->to($mail_to);
	$CI->email->subject($mail_subject);
	$CI->email->message($mail_message);
	$CI->email->send();
	$CI->email->clear();
}

/**
 * 发送邮件
 * @param unknown $recipient
 * @param string $subject
 * @param string $message
 */
function send_email($recipient, $subject = 'Test email', $message = 'Hello World')
{
	return mail($recipient, $subject, $message);
}

/**
 * 默认头像
 * */
function user_photo()
{
    return array(
        '0' => '0.jpg',
        '1' => '1.jpg',
        '2' => '2.jpg',
        '3' => '3.jpg',
        '4' => '4.jpg',
        '5' => '5.jpg',
        '6' => '6.jpg',
        '7' => '7.jpg',
        '8' => '8.jpg',
        '9' => '9.jpg',
    );
}

/**
 * 获取所有的分类
 * 菜单栏需要
 */
function getAllCategory(){

    $CI = & get_instance();
    $CI->load->model('Mall_category_model','mall_category');
    $allCategory = $CI->mall_category->getAllCategory();
    return $allCategory;
}


