<?php
//echo json_encode($_REQUEST);
//echo json_encode(array('foo' => 'bar'));

$url = $_POST['url'];
$method = $_POST['method'];
$dataJson = $_POST['dataJson'];
//$dataArr = json_decode($dataJson);
//echo $dataJson;exit;
echo 'success'; exit;

//$url = 'www.baidu.com';
//$method = 'get';
//$dataArr = array();

$result = curl::request($url, $method, $dataArr);
echo json_encode(array(
    'header' => 'header',
    'body' => $result,
));
//echo 'request success';
class curl {
    public static function request($url, $method = 'get', $data = array()){
        $ch = curl_init();

        // 结果作为返回值由变量接收
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 不显示header
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if ($method == 'post') {
            // 设置url
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            //if (is_array($data)) {
                //var_dump($data);
                //$data = json_encode($data);
                //echo "$data\n";
            //}
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else if ($method == 'get') {
            if (is_array($data)) {
                $url = $url . '?' . http_build_query($data);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
        }

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "$curl_errno\n";
        }

        curl_close($ch);

        return $result;
    }
}
