<?php


  require('simple_html_dom.php'); // for solar output

	
// Messwerte dummies


	$in_temp	= 35.5;
	$in_hum		= 58;
	$in_co2		= 2500;
	
	$out_pres	= 1234;
	$out_temp	= -22.5;
	$out_hum	= 99;
	
	$elw_temp 	= 18.8;
	$elw_hum 	= 55.5;
	$elw_co2 	= 432;
	
	$sch_temp 	= 9.1;
	$sch_hum 	= 65;
	$sch_co2 	= 1111;
	
	$rain_bool	= 1; // 0 = nein, 1 = ja? 
	$rain_1h	= 24.5;
	$rain_24h	= 123.4;
	
	
// Einheiten

	$deg 	= '°C';
	$mm 	= ' mm';
	$per 	= ' %';
	$pre	= ' mbar';
	$ppm 	= ' ppm';
	//-----------------
	$watt	= ' W';
	$watth	= ' Wh';
	
	
// Messwerte formatieren
	
	$out_temp	= number_format($out_temp, 1, ".", "").$deg;
	$out_hum	= number_format($out_hum,"0").$per;
	$out_pres	= number_format($out_pres,"0","","").$pre;
	
	
	$in_temp	= number_format($in_temp, 1, ".", "").$deg;
	$in_hum		= number_format($in_hum,"0").$per;
	$in_co2		= number_format($in_co2,"0","","").$ppm;

	
	$elw_temp	= number_format($elw_temp, 1, ".", "").$deg;
	$elw_hum	= number_format($elw_hum,0).$per;
	$elw_co2	= number_format($elw_co2,0,"","").$ppm;
	
	
	$sch_temp	= number_format($sch_temp, 1, ".", "").$deg;
	$sch_hum	= number_format($sch_hum,0,"","").$per;
	$sch_co2	= number_format($sch_co2,0,"","").$ppm;
	
	
	$rain_1h	= number_format($rain_1h, 1, ".", "") .$mm;
	$rain_24h	= number_format($rain_24h, 1, ".", "") .$mm;
	if($rain_bool == 0){
		$rain_bool = "nein";
	}else{
		$rain_bool = "ja";
	}
	

	
// Variablen
	
	$filename	= "/home/pi/Documents/output/weather-script-output_test.png";
	$font		= "/home/pi/Documents/fonts/Arial.ttf";
	
	
// Leere PNG-Datei mit weißem Hintergrund erstellen
	
	$image		= ImageCreateTrueColor(600, 800);
	$background	= ImageColorAllocate($image, 255, 255, 255);
	
	ImageFilledRectangle($image, 0, 0, 600, 800, $background);
	
	
// Farbe für Schrift und Hilfslinien festlegen, Schriftgrößen
	
	$color			= ImageColorAllocate($image, 0, 0, 0);
	$fontSizeText 	= 15;
	$fontSizeValue 	= 30;
	
	
// Zeilen- und Spaltenpositionen
	
	$spacingX 		= 200;
	$spacingY 		= 100;
	$offsetX 		= 15;
	$offsetY_Text 	= 30;
	$offsetY_Wert 	= 75;

	
	
// Text einfügen

	$zeile 	= 0;
	$spalte = 0;
	
	// Zeile 1
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Temperatur außen:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $out_temp);
	
	$spalte++;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Luftfeuchtigkeit:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $out_hum);
	
	$spalte++;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Luftdruck:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $out_pres);

	
	// -------------------------	
	$spalte = 0;
	$zeile++;
	
	ImageFilledRectangle($image, $offsetX, $zeile*$spacingY, 600-$offsetX, $zeile*$spacingY, $color);
	// -------------------------

	
	// Zeile 2
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Temperatur Wohnz.");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $in_temp);
	
	$spalte++;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Luftfeuchtigkeit:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $in_hum);
	
	$spalte++;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "CO2:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $in_co2);
	
	
	// -------------------------	
	$spalte = 0;
	$zeile++;
	
	ImageFilledRectangle($image, $offsetX, $zeile*$spacingY, 600-$offsetX, $zeile*$spacingY, $color);
	// -------------------------
	
	
	// Zeile 3
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Temperatur Schlafz.");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $sch_temp);
	
	$spalte++;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Luftfeuchtigkeit:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $sch_hum);
	
	$spalte++;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "CO2:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $sch_co2);
	
	
	// -------------------------	
	$spalte = 0;
	$zeile++;
	
	ImageFilledRectangle($image, $offsetX, $zeile*$spacingY, 600-$offsetX, $zeile*$spacingY, $color);
	// -------------------------
	
	
	// Zeile 4
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Temperatur ELW:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $elw_temp);
	
	$spalte++;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Luftfeuchtigkeit:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $elw_hum);
	
	$spalte++;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "CO2:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $elw_co2);
	
	
	// -------------------------	
	$spalte = 0;
	$zeile++;
	
	ImageFilledRectangle($image, $offsetX, $zeile*$spacingY, 600-$offsetX, $zeile*$spacingY, $color);
	// -------------------------
	
		
	// Zeile 5
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Regen aktuell:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $rain_bool);
	
	$spalte++;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Letzte Stunde:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $rain_1h);
	
	$spalte++;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Heute:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $rain_24h);
	
	
	// -------------------------	
	$spalte = 0;
	$zeile++;
	
	ImageFilledRectangle($image, $offsetX, $zeile*$spacingY, 600-$offsetX, $zeile*$spacingY, $color);
	// -------------------------

	
	
	
	
// Additional
	
	date_default_timezone_set('Europe/Berlin');
	$date = date('d/m/Y G:i', time());
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, 785, $color, $font, "Letztes Update: ".$date);
	
	
	
// Solar Output
	
	$html = file_get_html('https://www.sunnyportal.com/Templates/PublicPage.aspx?page=11aed090-c095-4046-8a1c-6f829adf8b3f');


// widget 0 -> Aktuelle PV-Leistung
	$widget_id = 0;	
    $widget=  $html->find('div.widgetBox',$widget_id);       
    $widgetBody =  $widget->find('div.widgetBody',0);
    $mainValue =  $widgetBody->find('div.mainValue',0);
    $mainValueAmount =  $mainValue->find('span.mainValueAmount',0);
    $dataValue = $mainValueAmount->{'data-value'};
	$solar_ouput_now = number_format($dataValue, 0, "", "").$watt;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Solar aktuell:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $solar_ouput_now);
	
	$spalte++;
	
// widget 1 -> Tagesleistung und Gesamtleistung
	$widget_id = 1;	
    $widget=  $html->find('div.widgetBox',$widget_id);       
    $widgetBody =  $widget->find('div.widgetBody',0);
	
    $mainValue = $widgetBody->find('div.mainValue',0);
	$dataValue = $mainValue->find('span.mainValueAmount',0);
	$dataValue = $dataValue->innertext;
	$solar_output_today = number_format($dataValue, 0, "", "").$watth;
	
	$widgetFooter = $widget->find('div.widgetFooter',0);
	$totalValue = $widgetFooter->find('span#ctl00_ContentPlaceHolder1_PublicPagePlaceholder1_PageUserControl_ctl00_PublicPageLoadFixPage_energyYieldWidget_energyYieldTotalValue',0);
	$totalValue = $totalValue->innertext;
	$solar_output_total =  number_format($totalValue, 0, "", "").$watth;
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Solar heute:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $solar_output_today);
	
	$spalte++;	// Totalwert steht im selben Widget
	
	ImageTTFText($image, $fontSizeText, 0, $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Text, $color, $font, "Solar total:");
	ImageTTFText($image, $fontSizeValue, 0,  $spalte*$spacingX+$offsetX, $zeile*$spacingY+$offsetY_Wert, $color, $font, $solar_output_total);
	
	
// PNG-erstellen und temporäre Daten löschen
	
	ImagePNG($image, $filename);
	ImageDestroy($image);
	
	
// Farbraum in Graustufen ändern
	
	$im = new Imagick();
	$im->readImage($filename);
	$im->setImageType(Imagick::IMGTYPE_GRAYSCALE);
	$im->writeImage($filename);
	
	
?>