<?php
		/*config
		$token	=	'3069618603.c0a94fa.f16eae4ff2ca416886ff015ecae31cef';
		$uid	=	'3069618603';
		My FB : Manggala Febri Valentino
		Spesical Thx To : Ghazi Muharam
		*/

echo "Masukkan UserId/Uid : ";
$uid 	= trim(fgets(STDIN));
echo "Masukkan Token : ";
$token 	= trim(fgets(STDIN));
echo "Masukkan Jumlah Suntik : ";
$jumlah	= trim(fgets(STDIN));
echo "SetSleep : ";
$sleep	= trim(fgets(STDIN));

for($i=0; $i<$jumlah; $i++){
	$photo_id	=	photoid($uid);
	$_id		=	_id($uid);
		while(empty($_id)){
			$_id	=	_id($uid);
		}
	$submit		=	submit($photo_id,$token);
	$check		=	json_decode($submit);
	$extra		=	extra($_id,$token);
	$check2		=	json_decode($extra);
	if(isset($check->error)){
		if($check->error == 'already follows'){
			$sleep	= $sleep+2;
		}
	}else{
	echo "$submit\n";
	echo "$extra\n";
	}
sleep($sleep);
}

function photoid($uid){ 
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://www.instagetlikes.ru/api/getPhotoTask');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "user_id=$uid"); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$headers 	= array();
				$headers[]	= 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = json_decode(curl_exec($ch));
	return $result->photo->photo_id;
} 
function submit($photo_id,$token){
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://www.instagetlikes.ru/api/addFollowers');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "photo_id=$photo_id&token=$token"); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$headers 	= array();
				$headers[]	= 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
	return $result;
}
function _id($uid){ 
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://www.instagetlikes.ru/api/getExtraOrders');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "user_id=$uid"); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$headers 	= array();
				$headers[]	= 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = json_decode(curl_exec($ch));
	return $result->order->_id;
}
function extra($_id,$token){
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://www.instagetlikes.ru/api/performExtraOrder');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "&token=$token&_id=$_id"); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$headers 	= array();
				$headers[]	= 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
	return $result;
}
?>
