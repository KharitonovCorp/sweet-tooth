<?php

use Intervention\Image\ImageManagerStatic as Image;
Image::configure(array('driver' => 'gd'));

function convertCyrillicURL($url) {
	$idn = new idna_convert(array('idn_version'=>2008));
	$url=(stripos($url, 'xn--')!==false) ? $idn->decode($url) : $idn->encode($url);
	return $url;
}

function saveImageURL($url)
{
	$saveDir = $_SERVER['DOCUMENT_ROOT'].'/images/uploads/';
	$fileName = hash('crc32' , time().$url);
	$fileType = '';
	$quality = 100;
	$url = convertCyrillicURL($url);
	$image = Image::make($url);
	if($image->mime() == 'image/jpeg')
	{
		$fileType = '.jpg';
		$image->widen(1500)->save($saveDir.'max-'.$fileName.$fileType, $quality);
		$image->widen(500)->save($saveDir.'min-'.$fileName.$fileType, $quality);
	}
	elseif($image->mime() == 'image/png')
	{
		$fileType = '.png';
		$image->widen(1500)->save($saveDir.'max-'.$fileName.$fileType, $quality);
		$image->widen(500)->save($saveDir.'min-'.$fileName.$fileType, $quality);
	}
	elseif($image->mime() == 'image/gif')
	{
		$fileType = '.gif';
		$image->widen(1500)->save($saveDir.'max-'.$fileName.$fileType, $quality);
		$image->widen(500)->save($saveDir.'min-'.$fileName.$fileType, $quality);
	}
	else
	{
		return false;
	}
	return $fileName.$fileType;
}

function saveImageFILE($file)
{
	$saveDir = $_SERVER['DOCUMENT_ROOT'].'/web/images/uploads/';
	$fileName = hash('crc32' , time().$file);
	$quality = 100;
	$image = Image::make($file);
	if($image->mime() == 'image/jpeg')
	{
		$fileType = '.jpg';
		$image->widen(1500)->save($saveDir.'max-'.$fileName.$fileType, $quality);
		$image->widen(500)->save($saveDir.'min-'.$fileName.$fileType, $quality);
	}
	elseif($image->mime() == 'image/png')
	{
		$fileType = '.png';
		$image->widen(1500)->save($saveDir.'max-'.$fileName.$fileType, $quality);
		$image->widen(500)->save($saveDir.'min-'.$fileName.$fileType, $quality);
	}
	elseif($image->mime() == 'image/gif')
	{
		$fileType = '.gif';
		$image->widen(1500)->save($saveDir.'max-'.$fileName.$fileType, $quality);
		$image->widen(500)->save($saveDir.'min-'.$fileName.$fileType, $quality);
	}
	else
	{
		return false;
	}
	return $fileName.$fileType;
}

function countTransformation($num)
{
    if ($num >= 1000000)
    {
        return floor($num/1000000) . 'M';
    }
    elseif ($num >= 1000)
    {
        return floor($num/1000) . 'K';
    }
    return $num;
}