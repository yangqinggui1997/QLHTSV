<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of helpers
 *
 * @author DELL
 */
class comm_functions {
    //put your code here
    
    public static function changeTitle($str,$strSymbol='_',$case=MB_CASE_LOWER){// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
        $str=trim($str);
        if ($str=="") return "";
        $str =str_replace('"','',$str);
        $str =str_replace("'",'',$str);
        $str = comm_functions::stripUnicode($str);
        $str = mb_convert_case($str,$case,'utf-8');
        $str = preg_replace('/[\W|-]+/',$strSymbol,$str);
        return $str;
    }

    public static function stripUnicode($str){
	if(!$str) return '';
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
		'ae'=>'ǽ',
		'AE'=>'Ǽ',
		'c'=>'ć|ç|ĉ|ċ|č',
		'C'=>'Ć|Ĉ|Ĉ|Ċ|Č',
		'd'=>'đ|ď',
		'D'=>'Đ|Ď',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
		'f'=>'ƒ',
		'F'=>'',
		'g'=>'ĝ|ğ|ġ|ģ',
		'G'=>'Ĝ|Ğ|Ġ|Ģ',
		'h'=>'ĥ|ħ',
		'H'=>'Ĥ|Ħ',
		'i'=>'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',	  
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
		'ij'=>'ĳ',	  
		'IJ'=>'Ĳ',
		'j'=>'ĵ',	  
		'J'=>'Ĵ',
		'k'=>'ķ',	  
		'K'=>'Ķ',
		'l'=>'ĺ|ļ|ľ|ŀ|ł',	  
		'L'=>'Ĺ|Ļ|Ľ|Ŀ|Ł',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
		'Oe'=>'œ',
		'OE'=>'Œ',
		'n'=>'ñ|ń|ņ|ň|ŉ',
		'N'=>'Ñ|Ń|Ņ|Ň',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
		's'=>'ŕ|ŗ|ř',
		'R'=>'Ŕ|Ŗ|Ř',
		's'=>'ß|ſ|ś|ŝ|ş|š',
		'S'=>'Ś|Ŝ|Ş|Š',
		't'=>'ţ|ť|ŧ',
		'T'=>'Ţ|Ť|Ŧ',
		'w'=>'ŵ',
		'W'=>'Ŵ',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
		'z'=>'ź|ż|ž',
		'Z'=>'Ź|Ż|Ž'
	);
	foreach($unicode as $khongdau=>$codau) {
		$arr=explode("|",$codau);
		$str = str_replace($arr,$khongdau,$str);
	}
	return $str;
}

    public static function setDanToc(){
        return array('Kinh','Chăm','Hoa','Khơ me','Bana','Bru - Vân Kiều','Brâu','Bố Y','Chu Ru','Chăm','Chơ Ro','Chứt','Co','Cơ Ho','Cơ Tu','Cống','Cờ Lao','Dao','Gia Rai','Giáy','Giẻ Triêng','Hrê','Hà Nhì','H’Mông','Kháng','Khơ Mú','La Chí','La Ha','La Hủ','Lào','Lô Lô','Lự','Mường','Mạ','Mảng','M’Nông','Ngái','Nùng','Phù Lá','Pu Péo','Pà Thẻn','Ra Glai','Rơ Măm','Si La','Sán Chay','Sán Dìu','Thái','Thổ','Tà Ôi','Tày','Xinh Mun','Xơ Đăng','X’Tiêng','Ê Đê','Ơ Đu');
    }
    
    public static function decodeDanToc($dantoc){
        switch ($dantoc){
            case 'kinh': return "Kinh"; case 'cham': return 'Chăm';case 'hoa': return 'Hoa';case 'kho_me': return 'Khơ me';case 'bana': return 'Bana';case 'bru_van_kieu': return 'Bru - Vân Kiều';case 'brau': return 'Brâu';case 'bo_y': return 'Bố Y';case 'chu_ru': return 'Chu Ru';case 'cham': return 'Chăm';case 'cho_ro': return 'Chơ Ro';case 'chut': return 'Chứt';case 'co': return 'Co';case 'co_ho': return 'Cơ Ho';case 'co_tu': return 'Cơ Tu';case 'cong': return 'Cống';case 'co_lao': return 'Cờ Lao';case 'dao': return 'Dao';case 'gia_rai': return 'Gia Rai';case 'giay': return 'Giáy';case 'gie_trieng': return 'Giẻ Triêng';case 'hre': return 'Hrê';case 'ha_nhi': return 'Hà Nhì';case 'h_mong': return 'H’Mông';case 'khang': return 'Kháng';case 'kho_mu': return 'Khơ Mú';case 'la_chi': return 'La Chí';case 'la_ha': return 'La Ha';case 'la_hu': return 'La Hủ';case 'lao': return 'Lào';case 'lo_lo': return 'Lô Lô';case 'lu': return 'Lự';case 'muong': return 'Mường';case 'ma': return 'Mạ';case 'mang': return 'Mảng';case 'm_nong': return 'M’Nông';case 'ngai': return 'Ngái';case 'nung': return 'Nùng';case 'phu_la': return 'Phù Lá';case 'pu_peo': return 'Pu Péo';case 'pa_then': return 'Pà Thẻn';case 'ra_giai': return 'Ra Glai';case 'ro_mam': return 'Rơ Măm';case 'si_la': return 'Si La';case 'san_chay': return 'Sán Chay';case 'san_diu': return 'Sán Dìu';case 'thai': return 'Thái';case 'tho': return 'Thổ';case 'ta_oi': return 'Tà Ôi';case 'tay': return 'Tày';case 'xinh_mun': return 'Xinh Mun';case 'xo_dang': return 'Xơ Đăng';case 'x_tieng': return 'X’Tiêng';case 'e_de': return 'Ê Đê';case 'o_du': return 'Ơ Đu';
        }
    }

    public static function getDanToc($dantoc){
        return comm_functions::changeTitle(comm_functions::convertIndexToTextDT($dantoc));
    }
    
    public static function convertIndexToTextDT($dantoc){
        switch ($dantoc){
            case 0: return "Kinh";case 1: return 'Chăm';case 2: return 'Hoa';case 3: return 'Khơ me';case 4: return 'Bana';case 5: return 'Bru - Vân Kiều';case 6: return 'Brâu';case 7: return 'Bố Y';case 8: return 'Chu Ru';case 9: return 'Chăm';case 10: return 'Chơ Ro';case 11: return 'Chứt';case 12: return 'Co';case 13: return 'Cơ Ho';case 14: return 'Cơ Tu';case 15: return 'Cống';case 16: return 'Cờ Lao';case 17: return 'Dao';case 18: return 'Gia Rai';case 19: return 'Giáy';case 20: return 'Giẻ Triêng';case 21: return 'Hrê';case 22: return 'Hà Nhì';case 23: return 'H’Mông';case 24: return 'Kháng';case 25: return 'Khơ Mú';case 26: return 'La Chí';case 27: return 'La Ha';case 28: return 'La Hủ';case 29: return 'Lào';case 30: return 'Lô Lô';case 31: return 'Lự';case 32: return 'Mường';case 33: return 'Mạ';case 34: return 'Mảng';case 35: return 'M’Nông';case 36: return 'Ngái';case 37: return 'Nùng';case 38: return 'Phù Lá';case 39: return 'Pu Péo';case 40: return 'Pà Thẻn';case 41: return 'Ra Glai';case 42: return 'Rơ Măm';case 43: return 'Si La';case 44: return 'Sán Chay';case 45: return 'Sán Dìu';case 46: return 'Thái';case 47: return 'Thổ';case 48: return 'Tà Ôi';case 49: return 'Tày';case 50: return 'Xinh Mun';case 51: return 'Xơ Đăng';case 52: return 'X’Tiêng';case 53: return 'Ê Đê';default: return 'Ơ Đu';
        }
    }
    
    public static function BigRandomNumber($min, $max) {
        $difference   = bcadd(bcsub($max,$min),1);
        $rand_percent = bcdiv(mt_rand(), mt_getrandmax(), 8); // 0 - 1.0
        return bcadd($min, bcmul($difference, $rand_percent, 8), 0);
    }
    
    //định dạng ngày giờ lưu trong csdl
    public static function enDateFormat($str){
        
        $y=substr($str,6, 4);
        $m=substr($str,3, 2);
        $d=substr($str,0, 2);
        $h=substr($str,11, 2);
        $mn=substr($str,14, 2);
        $s=substr($str,17, 2);
        
        $kq=$y."-".$m."-".$d." ".$h.":".$mn.":".$s;       

        return $kq;
    }
    
    public static function enDateFormatDateOnly($str){
        
        $y=substr($str,6, 4);
        $m=substr($str,3, 2);
        $d=substr($str,0, 2);
        
        $kq=$y."-".$m."-".$d;       

        return $kq;
    }
    
    //định dạng ngày giờ hiển thị lên web
    public static function deDateFormat ($str){
        $y=substr($str,0, 4);
        $m=substr($str,5, 2);
        $d=substr($str,8, 2);
        $h=substr($str,11, 2);
        $mn=substr($str,14, 2);
        $s=substr($str,17, 2);
        $hh= intval($h);
        if($hh>12){
            $hh = $hh - intval(12);
            if($hh < 10){
                $hh='0'.$hh;
            }
            $apm="PM";
        }
        else{
            if($hh < 10){
                $hh='0'.$hh;
            }
            $apm="AM";
        }
        $kq=$d."/".$m."/".$y." ".$hh.":".$mn.":".$s." ".$apm;
        return $kq;
    }
    
    //định dạng ngày giờ hiển thị lên form cập nhật
    public static function deDateFormatForUpdate ($str){
        
        $y=substr($str,0, 4);
        $m=substr($str,5, 2);
        $d=substr($str,8, 2);
        $h=substr($str,11, 2);
        $mn=substr($str,14, 2);
        $s=substr($str,17, 2);
        
        $kq=$d."/".$m."/".$y." ".$h.":".$mn.":".$s;
        return $kq;
    }
    
    
    public static function setDTK(){
        return array(['id'=>'DN', 'name'=>'Doanh nghiệp'], ['id'=>'HX', 'name'=>'Hợp tác xã'], ['id'=>'CH', 'name'=>'Viên chức nhà nước'], ['id'=>'NN', 'name'=>'Người lao động nước ngoài'], ['id'=>'TK', 'name'=>'Người lao động trong tổ chức khác'], ['id'=>'HC', 'name'=>'Cán bộ , viên chức theo luật cán bộ'], ['id'=>'XK', 'name'=>'Người hoạt động không chuyên trách cấp cơ sở'], ['id'=>'HT', 'name'=>'Người hưởng lương hưu, trợ cấp tháng'], ['id'=>'TB', 'name'=>'Người hưởng trợ cấp BHXH'], ['id'=>'NO', 'name'=>'Người lao động nghỉ việc được hưởng chế độ ốm đau'], ['id'=>'CT', 'name'=>'Người trên 80 tuổi'], ['id'=>'XB', 'name'=>'Cán bộ cơ sở hưởng trợ cấp BHXH'], ['id'=>'CS', 'name'=>'Công nhân cao su'], ['id'=>'QN', 'name'=>'Sỹ quan, quân nhân'], ['id'=>'CA', 'name'=>'Sỹ quan, hạ sỹ quan chuyên nghiệp'], ['id'=>'CY', 'name'=>'Người làm công tác sơ yếu tại Bộ, ngành và địa phương'], ['id'=>'XN', 'name'=>'Cán bộ cơ sở hưởng trợ cấp ngân sách nhà nước'], ['id'=>'MS', 'name'=>'Người đã thôi hưởng trợ cấp mất sức lao động'], ['id'=>'CC', 'name'=>'Người có công với cách mạng'], ['id'=>'CK', 'name'=>'Người có công với cách mạng ngoại trừ CC'], ['id'=>'CB', 'name'=>'Cựu chiến binh'], ['id'=>'KC', 'name'=>'Người tham gia chống Pháp, Mỹ ngoại trừ CC,CK, CB'], ['id'=>'HD', 'name'=>'Đại biểu quốc hội, hội đồng nhân dân'], ['id'=>'TE', 'name'=>'Trẻ em dưới 6 tuổi'], ['id'=>'BT', 'name'=>'Người hưởng bảo trợ xã hội hàng tháng'], ['id'=>'HN', 'name'=>'Hộ nghèo'], ['id'=>'DT', 'name'=>'Người dân tộc thiểu số'], ['id'=>'DK', 'name'=>'Người sống tại vùng kinh tế đặc biệt khó khăn'], ['id'=>'XD', 'name'=>'Người đang sinh sống ở đảo'], ['id'=>'TS', 'name'=>'Thân nhân người có công cách mạng'], ['id'=>'TC', 'name'=>'Thanh nhân người có công cách mạng ngoại trừ TS'], ['id'=>'TQ', 'name'=>'Thân nhân của QN'], ['id'=>'TA', 'name'=>'Thân nhân của CA'], ['id'=>'TY', 'name'=>'Thân nhân của CY'], ['id'=>'HG', 'name'=>'Người hiến bộ phận cơ thể'], ['id'=>'LS', 'name'=>'Người nước ngoài'], ['id'=>'PV', 'name'=>'Người phục vụ người có công với cách mạng'], ['id'=>'CN', 'name'=>'Hộ cận nghèo'], ['id'=>'HS', 'name'=>'Học sinh'], ['id'=>'SV', 'name'=>'Sinh viên'], ['id'=>'GB', 'name'=>'Lao động nông ngiệp có mức sống trung bình'], ['id'=>'GD', 'name'=>'Gia đình']);
    }
    
    public static function getMucHuongDTK($dt){
        switch($dt){
            case 'TE':case 'CC':case 'CK':case 'CB':case 'KC':case 'HN':case 'DT':case 'DK':case 'XD':case 'BT':case 'TS':case 'QN':case 'CA':case 'CY': $dt=100;break;
            case 'HT':case 'TC':case 'CN': $dt=95;break;
            case 'DN':case 'HX':case 'CH':case 'NN':case 'TK':case 'HC':case 'XK':case 'TB':case 'NO':case 'CT':case 'XB': case 'TN':case 'CS':case 'XN':case 'MS':case 'HD':case 'TQ':case 'TA':case 'TY':case 'HG':case 'LS':case 'PV':case 'HS':case 'SV':case 'GB':case 'GD': $dt=80;break;
        }
        return $dt;
    }
    
    public static function getDTK($dt){
        switch($dt){
            case 'DN': $dt='Doanh nghiệp';break;case 'HX': $dt='Hợp tác xã';break;case 'CH': $dt='Viên chức nhà nước';break;
            case 'NN': $dt='Người lao động nước ngoài';break;case 'TK': $dt='Người lao động trong tổ chức khác';break;case 'HC': $dt='Cán bộ , viên chức theo luật cán bộ';break;
            case 'XK': $dt='Người hoạt động không chuyên trách cấp cơ sở';break;case 'HT': $dt='Người hưởng lương hưu, trợ cấp tháng';break;case 'TB': $dt='Người hưởng trợ cấp BHXH';break;
            case 'NO': $dt='Người lao động nghỉ việc được hưởng chế độ ốm đau';break;case 'CT': $dt='Người trên 80 tuổi';break;case 'XB': $dt='Cán bộ cơ sở hưởng trợ cấp BHXH';break;
            case 'CS': $dt='Công nhân cao su';break;case 'QN': $dt='Sỹ quan, quân nhân';break;case 'CA': $dt='Sỹ quan, hạ sỹ quan chuyên nghiệp';break;
            case 'CY': $dt='Người làm công tác sơ yếu tại Bộ, ngành và địa phương';break;case 'XN': $dt='Cán bộ cơ sở hưởng trợ cấp ngân sách nhà nước';break;case 'MS': $dt='Người đã thôi hưởng trợ cấp mất sức lao động';break;
            case 'CC': $dt='Người có công với cách mạng';break;case 'CK': $dt='Người có công với cách mạng ngoại trừ CC';break;case 'CB': $dt='Cựu chiến binh';break;
            case 'KC': $dt='Người tham gia chống Pháp, Mỹ ngoại trừ CC,CK, CB';break;case 'HD': $dt='Đại biểu quốc hội, hội đồng nhân dân';break;case 'TE': $dt='Trẻ em dưới 6 tuổi';break;
            case 'BT': $dt='Người hưởng bảo trợ xã hội hàng tháng';break;case 'HN': $dt='Hộ nghèo';break;case 'DT': $dt='Người dân tộc thiểu số';break;
            case 'DK': $dt='Người sống tại vùng kinh tế đặc biệt khó khăn';break;case 'XD': $dt='Người đang sinh sống ở đảo';break;case 'TS': $dt='Thân nhân người có công cách mạng';break;
            case 'TC': $dt='Thanh nhân người có công cách mạng ngoại trừ TS';break;case 'TQ': $dt='Thân nhân của QN';break;case 'TA': $dt='Thân nhân của CA';break;
            case 'TY': $dt='Thân nhân của CY';break;case 'HG': $dt='Người hiến bộ phận cơ thể';break;case 'LS': $dt='Người nước ngoài';break;
            case 'PV': $dt='Người phục vụ người có công với cách mạng';break;case 'CN': $dt='Hộ cận nghèo';break;case 'HS': $dt='Học sinh';break;
            case 'SV': $dt='Sinh viên';break;case 'GB': $dt='Lao động nông ngiệp có mức sống trung bình';break;case 'GD': $dt='Gia đình';break;
        }
        return $dt;
    }
    
    public static function getCachDungThuoc($cd){
        switch($cd){
            case 'uong': $cd='Uống';break;
            case 'tiem_chich': $cd='Tiêm (chích)';break;
            case 'thoi_khi_truyen_hoi': $cd='Thỏi khí (truyền hơi)';break;
            case 'truyen_dich': $cd='Truyền dịch';break;
            case 'xit': $cd='Xịt';break;
            case 'dan': $cd='Dán';break;
            case 'nho_giot': $cd='Nhỏ giọt';break;
            case 'boi': $cd='Bôi (thoa)';break;
            default: $cd='Đặt (để)';break;
        }
        return $cd;
    }
    
    public static function decodeDVT($dvt){
        switch ($dvt){
            case 'lan': return "Lần";case 'hop': return 'Hộp';case 'vien': return 'Viên';case 'vi': return 'Vĩ';case 'tuyp': return 'Tuýp';case 'ong': return 'Ống';case 'cai': return 'Cái';case 'goi': return 'Gói';case 'mieng': return 'Miếng';case 'bich': return 'Bịch';case 'lo': return 'Lọ'; case 'ngay': return 'Ngày'; default: return 'Chiếc';
        }
    }
    
    public static function decodeCongViec($congviec){
        switch ($congviec){
            case 'quan_tri_he_thong': return "Quản trị hệ thống";case 'quan_ly_benh_vien': return 'Quản lý bệnh viện';case 'hanh_chinh_tong_hop': return 'Hành chính tổng hợp';case 'bac_si_chuyen_khoa_kham_va_dieu_tri': return 'Bác sĩ chuyên khoa khám và điều trị';case 'bac_si_ky_thuat_cls': return 'Bác sĩ kỹ thuật cận lâm sàng';case 'bac_si_cap_cuu': return 'Bác sĩ trực cấp cứu';case 'ke_toan': return 'Kế toán';case 'tiep_don_kham_benh': return 'Tiếp đón bệnh nhân đến khám';case 'tiep_don_cc': return 'Trực tiếp nhận cấp cứu';case 'phat_thuoc': return 'Phát thuốc';case 'ky_thuat_dien': return 'Kỹ thuật điện';case 'ky_thuat_y_te': return 'Kỹ thuật y tế';case 'lao_cong': return 'Lao công';default: return 'Bảo vệ';
        }
    }
    
    public static function decodeCV($chucvu){
        switch ($chucvu){
            case 'giam_doc': return "Giám đốc";case 'truong_khoa': return 'Trưởng khoa';case 'pho_truong_khoa': return 'Phó trưởng khoa';case 'truong_phong': return 'Trưởng phòng';case 'pho_truong_phong': return 'Phó trưởng phòng';case 'nhan_vien': return 'Nhân viên';default: return 'Chuyên viên';
        }
    }
    
    public static function decodeKhoa($khoa){
        switch ($khoa){
            case 'khoa_kham': return "Khoa khám và điều trị";case 'hoi_suc_cap_cuu': return 'Khoa chức năng cấp cứu';case 'can_lam_sang': return 'Khoa chức năng chuẩn đoán cận lâm sàng';case 'phau_thuat': return 'Khoa chức năng phẫu thuật';case 'hanh_chinh_tong_hop': return 'Khoa chức năng hành chính';case 'ke_toan': return 'Khoa chức năng kế toán (thu ngân)';case 'quan_tri': return 'Khoa chức năng quản trị hệ thống';case 'tiep_don_cap_cuu': return 'Khoa chức tiếp đón cấp cứu';case 'tiep_don_kham_benh': return 'Khoa chức năng tiếp đón khám bệnh';case 'bao_ve_lao_cong': return 'Khoa chức năng bảo vệ an ninh và lao công';default: return 'Khoa chức năng cấp phát thuốc';
        }
    }
    
    public static function decodeTrinhDo($trinhdo){
        switch ($trinhdo){
            case 'giao_su': return "Giáo sư";case 'pho_giao_su': return 'Phó giáo sư';case 'pho_giao_su_ts': return 'Phó giáo sư - Tiến sĩ';case 'tien_si': return 'Tiến sĩ';case 'thac_si': return 'Thạc sĩ';case 'cu_nhan': return 'Cử nhân';case 'cao_dang': return 'Cao đẳng';case 'trung_cap': return 'Trung cấp'; default: return 'Dưới trung cấp';
        }
    }
    
    public static function decodePPDT($ppdt){
        switch ($ppdt){
            case 'dung_thuoc': return "Dùng thuốc";case 'phau_thuat': return 'Phẫu thuật';case 'tieu_phau': return 'Tiểu phẫu';case 'tieu_phau_vs_dung_thuoc': return 'Tiểu phẫu + dùng thuốc';case 'phau_thuat_vs_dung_thuoc': return 'Phẫu thuật + dùng thuốc';default: return 'Thực hiện CLS + dùng thuốc';
        }
    }
    
    public static function decodeTTBN($ttbn){
        switch ($ttbn){
            case 'khoi_benh_hoan_toan': return "Khỏi bệnh hoàn toàn";
            case 'do_nhieu': return 'Đỡ nhiều';
            case 'do_mot_phan': return 'Đỡ một phần';
            case 'khong_khuyen_giam': return 'Không khuyên giảm';
            case 'benh_tien_trien_xau': return 'Bệnh tiến triển xấu';
            case 'dang_theo_doi': return 'Đang theo dõi';
            default: return 'Tử vong';
        }
    }
    
    public static function decodeLoaiTB($loaitb){
        switch ($loaitb){
            case 'giuong_benh': return "Giường bệnh";
            case 'bo_thu_chan_doan_benh_sot_ret': return 'Bộ thử chẩn đoán bệnh sốt rét';
            case 'cac_san_pham_da_hoac_chua_pha_tron_dung_cho_phong_benh_hoac_chua_benh': return 'Các sản phẩm đã hoặc chưa pha trộn dùng cho phòng bệnh hoặc chữa bệnh (ví dụ: dung dịch xịt hoặc kem phòng ngừa loét do tì đè; dung dịch muối biển vệ sinh mũi; xịt mũi nước biển; xịt tai, xịt họng; nước mắt nhân tạo; nhũ tương nhỏ mắt; gel hoặc dung dịch làm ẩm, làm mềm vết thương, gel dùng cho vết thương ở miệng; dịch lọc thận...)';
            case 'bang_dan_va_cac_san_pham_co_mot_lop_dinh_da_trang_phu_hoac_tham_tam_duoc_chat': return 'Băng dán và các sản phẩm có một lớp dính đã tráng phủ hoặc thấm tẩm dược chất';
            case 'bang_dan_va_cac_san_pham_co_mot_lop_dinh_khong_trang_phu_hoac_khong_tham_tam_duoc_chat': return 'Băng dán và các sản phẩm có một lớp dính không tráng phủ hoặc không thấm tẩm dược chất (ví dụ: miếng dán sát khuẩn; miếng dán hạ sốt; miếng dán lạnh; miếng dán giữ nhiệt...)';
            case 'bang_y_te': return 'Băng y tế';
            case 'gac_y_te': return 'Gạc y tế';
            case 'bong_y_te': return 'Bông y tế';
            case 'chi_tu_tieu_vo_trung_dung_cho_nha_khoa_hoac_phau_thuat_mieng_chan_dinh_mieng_dem_vo_trung_dung_trong_nha_khoa_hoac_phau_thuat_co_hoac_khong_tu_tieu': return 'Chỉ tự tiêu vô trùng dùng cho nha khoa hoặc phẫu thuật; miếng chắn dính, miếng đệm vô trùng dùng trong nha khoa hoặc phẫu thuật, có hoặc không tự tiêu';
            case 'chi_khong_tu_tieu_san_pham_cam_mau_tu_tieu_vo_trung_trong_phau_thuat_hoac_nha_khoa_vat_lieu_cam_mau_tam_nang_phau_thuat_luoi_dieu_tri_thoat_vi_keo_dan_sinh_hoc_mang_ngan_hap_thu_sinh_hoc_keo_tao_mang_vo_trung_dung_de_khep_mieng_vet_thuong_trong_phau_thuat_tao_nong_vo_trung_va_nut_tao_nong_vo_trung': return 'Chỉ không tự tiêu, sản phẩm cầm máu tự tiêu vô trùng trong phẫu thuật hoặc nha khoa; vật liệu cầm máu; tấm nâng phẫu thuật; lưới Điều trị thoát vị; keo dán sinh học; màng ngăn hấp thu sinh học; keo tạo màng vô trùng dùng để khép miệng vết thương trong phẫu thuật; tảo nong vô trùng và nút tảo nong vô trùng';
            case 'chat_thu_nhom_mau': return 'Chất thử nhóm máu';
            case 'xi_mang_han_rang_va_cac_chat_han_rang_khac': return 'Xi măng hàn răng và các chất hàn răng khác';
            case 'hop_bo_dung_cu_cap_cuu_bo_kit_cham_soc_vet_thuong': return 'Hộp, bộ dụng cụ cấp cứu; bộ kít chăm sóc vết thương';
            case 'cac_che_pham_gel_duoc_san_xuat_de_dung_cho_nguoi_nhu_chat_boi_tron_cho_cac_bo_phan_cua_co_the_khi_tien_hanh_phau_thuat_hoac_kham_benh_hoac_nhu_mot_chat_gan_ket_giua_co_the_va_thiet_bi_y_te_vi_du_gel_sieu_am_gel_boi_tron_am_dao_dich_nhay_dung_trong_phau_thuat_phaco_': return 'Các chế phẩm gel được sản xuất để dùng cho người như chất bôi trơn cho các bộ phận của cơ thể khi tiến hành phẫu thuật hoặc khám bệnh hoặc như một chất gắn kết giữa cơ thể và thiết bị y tế (ví dụ: gel siêu âm, gel bôi trơn âm đạo; dịch nhầy dùng trong phẫu thuật Phaco...)';
            case 'dung_cu_chuyen_dung_cho_mo_tao_hau_mon_gia': return 'Dụng cụ chuyên dụng cho mổ tạo hậu môn giả';
            case 'dung_dich_ngam_rua_lam_sach_bao_quan_kinh_ap_trong': return 'Dung dịch ngâm, rửa, làm sạch, bảo quản kính áp tròng';
            case 'phim_x_quang_dung_trong_y_te': return 'Phim X quang dùng trong y tế';
            case 'tam_cam_bien_nhan_anh_x_quang_y_te': return 'Tấm cảm biến nhận ảnh X quang y tế';
            case 'dung_dich_hoa_chat_khu_khuan_dung_cu_thiet_bi_y_te': return 'Dung dịch, hóa chất khử khuẩn dụng cụ, thiết bị y tế';
            case 'tam_phien_mang_la_va_dai_bang_plastic_duoc_tham_tam_hoac_trang_phu_chat_thu_chan_doan_benh': return 'Tấm, phiến, màng, lá và dải bằng plastic được thấm, tẩm hoặc tráng phủ chất thử chẩn đoán bệnh';
            case 'bia_tam_xo_soi_xenlulo_va_mang_xo_soi_xenlulo_duoc_tham_tam_hoac_trang_phu_chat_thu_chan_doan_benh': return 'Bìa, tấm xơ sợi xenlulo và màng xơ sợi xenlulo được thấm, tẩm hoặc tráng phủ chất thử chẩn đoán bệnh';
            case 'chat_thu_chuan_doan_benh_khac': return 'Chất thử chẩn đoán bệnh khác (ví dụ: que thử, khay thử; chất thử, chất hiệu chuẩn, vật liệu kiểm soát in vitro...)';
            case 'chat_thu_chan_doan_benh_khac_vi_du_que_thu_khay_thu_chat_thu_chat_hieu_chuan_vat_lieu_kiem_soat_in_vitro': return 'Đang theo dõi';
            case 'dang_theo_doi': return 'Chất thử chẩn đoán bệnh khác (ví dụ: que thử, khay thử; chất thử, chất hiệu chuẩn, vật liệu kiểm soát in vitro...)';
            case 'cac_san_pham_khac_bang_plastic_vi_du_cuvet_dau_con_khay_ngam_dung_cu_tiet_khuan_bo_chuyen_tiep_ong_noi_mieng_nep_sau_phau_thuat_mat_na_co_dinh_kep_ong_thong_day_dan_mieng_dan_giu_ong_thong_tui_dung_nuoc_tieu_tui_dung_dich_xa_trong_loc_mang_bung_ong_nghiem_chua_chat_chong_dong_tui_ep_tiet_trung_bao_bi_dung_dung_cu_khong_chua_giay_bao_chup_dau_den_bao_camera_noi_soi_tui_dung_benh_pham_noi_soi_': return 'Các sản phẩm khác bằng plastic (ví dụ: cuvet, đầu côn, khay ngâm dụng cụ tiệt khuẩn; bộ chuyển tiếp, ống nối; miếng nẹp sau phẫu thuật; mặt nạ cố định; kẹp ống thông, dây dẫn; miếng dán giữ ống thông; túi đựng nước tiểu; túi đựng dịch xả trong lọc màng bụng; ống nghiệm chứa chất chống đông; túi ép tiệt trùng, bao bì đựng dụng cụ không chứa giấy; bao chụp đầu đèn; bao camera nội soi; túi đựng bệnh phẩm nội soi...)';
            case 'gang_tay_phau_thuat': return 'Găng tay phẫu thuật';
            case 'gang_kham': return 'Găng khám';
            case 'mat_hang_bao_bi_dung_trong_xu_ly_tiet_trung_dung_cu_y_te_dang_tui_lam_tu_nhua_va_giay_giay_chiem_ham_luong_nhieu_hon_gom_hai_mat_mot_mat_bang_plastic_mot_mat_bang_giay_duoc_dan_kin_3_canh_canh_con_lai_co_mot_dai_bang_keo_de_co_the_dan_tui_tui_dang_da_dong_goi_ban_le': return 'Mặt hàng bao bì dùng trong xử lý tiệt trùng dụng cụ y tế, dạng túi làm từ nhựa và giấy (giấy chiếm hàm lượng nhiều hơn), gồm hai mặt (một mặt bằng plastic, một mặt bằng giấy), được dán kín 3 cạnh, cạnh còn lại có một dải băng keo để có thể dán túi. Túi dạng đã đóng gói bán lẻ.';
            case 'mat_hang_san_pham_dung_trong_xu_ly_tiet_trung_dung_cu_y_te_dang_ong_duoc_ep_det_gom_2_mat_mot_mat_bang_giay_mot_mat_bang_polyester_giay_chiem_ham_luong_nhieu_hon_da_duoc_dan_kin_2_canh_voi_nhau_dong_thanh_dang_cuon': return 'Mặt hàng sản phẩm dùng trong xử lý tiệt trùng dụng cụ y tế, dạng ống được ép dẹt, gồm 2 mặt (một mặt bằng giấy, một mặt bằng polyester, giấy chiếm hàm lượng nhiều hơn) đã được dán kín 2 cạnh với nhau, đóng thành dạng cuộn';
            case 'tat_vo_dung_cho_nguoi_gian_tinh_mach_tu_soi_tong_hop': return 'Tất, vớ dùng cho người giãn tĩnh mạch, từ sợi tổng hợp';
            case 'ao_phau_thuat': return 'Áo phẫu thuật';
            case 'hang_may_mac_tu_bong_loai_co_tinh_dan_hoi_bo_chat_de_dieu_tri_mo_vet_seo_va_ghep_da': return 'Hàng may mặc từ bông, loại có tính đàn hồi bó chặt để Điều trị mô vết sẹo và ghép da';
            case 'hang_may_mac_tu_vat_lieu_det_khac_loai_co_tinh_dan_hoi_bo_chat_de_dieu_tri_mo_vet_seo_va_ghep_da': return 'Hàng may mặc từ vật liệu dệt khác, loại có tính đàn hồi bó chặt để Điều trị mô vết sẹo và ghép da';
            case 'khau_trang_phau_thuat': return 'Khẩu trang phẫu thuật';
            case 'thiet_bi_khu_trung_dung_trong_y_te_phau_thuat_vi_du_may_hap_tiet_trung_noi_hap_tiet_trung_may_tiet_trung_nhiet_do_thap_cong_nghe_plasma_': return 'Thiết bị khử trùng dùng trong y tế, phẫu thuật (Ví dụ: máy hấp tiệt trùng; nồi hấp tiệt trùng; máy tiệt trùng nhiệt độ thấp công nghệ plasma;...)';
            case 'may_ly_tam_chuyen_dung_trong_chan_doan_xet_nghiem_sang_loc_y_te': return 'Đang theo dõi';
            case 'may_ly_tam_chuyen_dung_trong_chan_doan_xet_nghiem_sang_loc_y_te': return 'Máy ly tâm chuyên dùng trong chẩn đoán, xét nghiệm, sàng lọc y tế';
            case 'xe_lan_xe_day_cang_cuu_thuong_va_cac_xe_tuong_tu_duoc_thiet_ke_dac_biet_de_cho_nguoi_tan_tat_co_hoac_khong_co_co_cau_van_hanh_co_gioi': return 'Xe lăn, xe đẩy, cáng cứu thương và các xe tương tự được thiết kế đặc biệt để chở người tàn tật có hoặc không có cơ cấu vận hành cơ giới';
            case 'kinh_ap_trong_can_vien_loan': return 'Kính áp tròng (cận, viễn, loạn)';
            case 'kinh_lup_phau_thuat_thiet_bi_soi_da': return 'Kính lúp phẫu thuật, thiết bị soi da';
            case 'kinh_thuoc': return 'Kính thuốc';
            case 'kinh_hien_vi_phau_thuat': return 'Kính hiển vi phẫu thuật';
            case 'may_chieu_tia_laser_co2_dieu_tri': return 'Máy chiếu tia laser CO2 Điều trị';
            case 'thiet_bi_dien_tim': return 'Thiết bị điện tim';
            case 'thiet_bi_sieu_am_dung_trong_y_te_vi_du_may_sieu_am_chan_doan_may_do_do_loang_xuong_bang_sieu_am_may_do_nhip_tim_thai_bang_sieu_am_he_thong_thiet_bi_sieu_am_cuong_do_cao_dieu_tri_khoi_u': return 'Thiết bị siêu âm dùng trong y tế (ví dụ: máy siêu âm chẩn đoán; máy đo độ loãng xương bằng siêu âm; máy đo nhịp tim thai bằng siêu âm, hệ thống thiết bị siêu âm cường độ cao Điều trị khối u...)';
            case 'thiet_bi_chup_cong_huong_tu': return 'Thiết bị chụp cộng hưởng từ';
            case 'thiet_bi_ghi_bieu_do_nhap_nhay': return 'Thiết bị ghi biểu đồ nhấp nháy';
            case 'may_theo_doi_benh_nhan_may_do_do_vang_da_may_dien_nao_may_dien_co_he_thong_noi_soi_chan_doan_may_do_phan_tich_chuc_nang_ho_hap_thiet_bi_dinh_vi_trong_phau_thuat_va_thiet_bi_kiem_tra_tham_do_chuc_nang_hoac_kiem_tra_thong_so_sinh_ly_khac': return 'Máy theo dõi bệnh nhân; máy đo độ vàng da; máy điện não; máy điện cơ; hệ thống nội soi chẩn đoán; máy đo/phân tích chức năng hô hấp; thiết bị định vị trong phẫu thuật và thiết bị kiểm tra thăm dò chức năng hoặc kiểm tra thông số sinh lý khác';
            case 'bom_tiem_dung_mot_lan': return 'Bơm tiêm dùng một lần';
            case 'bom_tiem_dien_may_truyen_dich': return 'Bơm tiêm điện, máy truyền dịch';
            case 'kim_tiem_bang_kim_loai_kim_khau_vet_thuong_kim_phau_thuat_bang_kim_loai_kim_but_lay_mau_va_dich_co_the_kim_dung_voi_he_thong_than_nhan_tao_kim_luon_mach_mau': return 'Kim tiêm bằng kim loại, kim khâu vết thương; kim phẫu thuật bằng kim loại; kim, bút lấy máu và dịch cơ thể; kim dùng với hệ thống thận nhân tạo; kim luồn mạch máu';
            case 'ong_thong_duong_tieu': return 'Ống thông đường tiểu';
            case 'ong_thong_ong_dan_luu_va_loai_tuong_tu_khac_vi_du_dung_cu_mo_duong_vao_mach_mau_bo_kit_pool_tieu_cau_va_loc_bach_cau_day_noi_qua_loc_mau_rut_nuoc_day_dan_mau_day_thong_da_day_ong_thong_cho_an_dung_cu_lay_mau_mau_day_noi_dai_bom_tiem_dien_ong_dan_luu_ong_thong': return 'Ống thông, ống dẫn lưu và loại tương tự khác (ví dụ: dụng cụ mở đường vào mạch máu; bộ kít pool tiểu cầu và lọc bạch cầu; dây nối quả lọc máu rút nước; dây dẫn máu; dây thông dạ dày; ống thông cho ăn; dụng cụ lấy máu mẫu; dây nối dài bơm tiêm điện; ống dẫn lưu, ống thông...)';
            case 'khoan_dung_trong_nha_khoa_co_hoac_khong_gan_lien_cung_mot_gia_do_voi_thiet_bi_nha_khoa_khac': return 'Khoan dùng trong nha khoa, có hoặc không gắn liền cùng một giá đỡ với thiết bị nha khoa khác';
            case 'thiet_bi_va_dung_cu_nhan_khoa_khac_vi_du_may_do_khuc_xa_giac_mac_tu_dong_may_do_dien_vong_mac_may_chup_cat_lop_day_mat_may_chup_huynh_quang_day_mat_he_thong_phau_thuat_chuyen_nganh_nhan_khoa_laser_excimer_phemtosecond_laser_phaco_may_cat_dich_kinh_may_cat_vat_giac_mac_may_laser_dieu_tri_dung_trong_nhan_khoa_dung_cu_thong_ap_luc_noi_nhan_trong_phau_thuat_glocom_': return 'Thiết bị và dụng cụ nhãn khoa khác (ví dụ: máy đo khúc xạ, giác mạc tự động; máy đo điện võng mạc; máy chụp cắt lớp đáy mắt, máy chụp huỳnh quang đáy mắt; hệ thống phẫu thuật chuyên ngành nhãn khoa (laser excimer, phemtosecond laser, phaco, máy cắt dịch kính, máy cắt vạt giác mạc); máy laser Điều trị dùng trong nhãn khoa; dụng cụ thông áp lực nội nhãn trong phẫu thuật glôcôm...)';
            case 'bo_theo_doi_tinh_mach_may_soi_tinh_mach': return 'Bộ theo dõi tĩnh mạch, máy soi tĩnh mạch';
            case 'dung_cu_va_thiet_bi_dien_tu_dung_cho_nganh_y_phau_thuat_nha_khoa_vi_du_may_pha_rung_tim_dao_mo_dien_dao_mo_sieu_am_dao_mo_laser_may_gay_me_kem_tho_may_giup_tho_long_ap_tre_so_sinh_he_thong_tan_soi_thiet_bi_loc_mau_thiet_bi_phau_thuat_lanh_may_tim_phoi_nhan_tao_may_loc_gan_may_chay_than_nhan_tao_may_tham_phan_phuc_mac_cho_benh_nhan_suy_than_he_thong_phau_thuat_tien_liet_tuyen_': return 'Dụng cụ và thiết bị điện tử dùng cho ngành y, phẫu thuật, nha khoa (ví dụ: máy phá rung tim; dao mổ điện; dao mổ siêu âm; dao mổ laser; máy gây mê kèm thở; máy giúp thở; lồng ấp trẻ sơ sinh; hệ thống tán sỏi; thiết bị lọc máu; thiết bị phẫu thuật lạnh; máy tim phổi nhân tạo; máy lọc gan; máy chạy thận nhân tạo, máy thẩm phân phúc mạc cho bệnh nhân suy thận; hệ thống phẫu thuật tiền liệt tuyến...)';
            case 'thiet_bi_va_dung_cu_dung_cho_nganh_y_thuoc_nhom_9018_nhung_chua_duoc_dinh_danh_cu_the_trong_danh_muc_hang_hoa_xuat_nhap_khau_viet_nam_va_danh_muc_ban_hanh_kem_thong_tu_nay_': return 'Thiết bị và dụng cụ dùng cho ngành y thuộc nhóm 9018 nhưng chưa được định danh cụ thể trong Danh Mục hàng hóa xuất nhập khẩu Việt Nam và Danh Mục ban hành kèm Thông tư này';
            case 'cac_dung_cu_chinh_hinh_hoac_dinh_nep_vit_xuong': return 'Các dụng cụ chỉnh hình hoặc đinh, nẹp, vít xương';
            case 'rang_gia': return 'Răng giả';
            case 'chi_tiet_gan_dung_trong_nha_khoa': return 'Đang theo dõi';
            case 'chi_tiet_gan_dung_trong_nha_khoa': return 'Chi Tiết gắn dùng trong nha khoa';
            case 'khop_gia': return 'Khớp giả';
            case 'cac_bo_phan_nhan_tao_khac_cua_co_the': return 'Các bộ phận nhân tạo khác của cơ thể';
            case 'thiet_bi_tro_thinh_tru_cac_bo_phan_va_phu_kien': return 'Thiết bị trợ thính, trừ các bộ phận và phụ kiện';
            case 'thiet_bi_dieu_hoa_nhip_tim_dung_cho_viec_kich_thich_co_tim_tru_cac_bo_phan_va_phu_kien': return 'Thiết bị Điều hòa nhịp tim dùng cho việc kích thích cơ tim, trừ các bộ phận và phụ kiện';
            case 'dung_cu_khac_duoc_lap_hoac_mang_theo_hoac_cay_ghep_vao_co_the_de_bu_dap_khuyet_tat_hay_su_suy_giam_cua_bo_phan_co_the_vi_du_khung_gia_do_mach_vanh_hat_nut_mach_luoi_loc_huyet_khoi_dung_cu_dong_dong_mach_thuy_tinh_the_nhan_tao': return 'Dụng cụ khác được lắp hoặc mang theo hoặc cấy ghép vào cơ thể để bù đắp khuyết tật hay sự suy giảm của bộ phận cơ thể (ví dụ: khung giá đỡ mạch vành, hạt nút mạch, lưới lọc huyết khối, dụng cụ đóng động mạch; thủy tinh thể nhân tạo...)';
            case 'thiet_bi_chup_cat_lop_ct_dieu_khien_bang_may_tinh': return 'Thiết bị chụp cắt lớp (CT) Điều khiển bằng máy tính';
            case 'thiet_bi_chan_doan_hoac_dieu_tri_su_dung_trong_nha_khoa': return 'Thiết bị chẩn đoán hoặc Điều trị sử dụng trong nha khoa';
            case 'thiet_bi_su_dung_tia_x_dung_chan_doan_hoac_dieu_tri_su_dung_cho_muc_dich_y_hoc_phau_thuat': return 'Thiết bị sử dụng tia X dùng chẩn đoán hoặc Điều trị sử dụng cho Mục đích y học, phẫu thuật';
            case 'thiet_bi_su_dung_tia_alpha_beta_hay_gamma': return 'Thiết bị sử dụng tia alpha, beta hay gamma dùng cho Mục đích y học, phẫu thuật, nha khoa kể cả thiết bị chụp hoặc thiết bị Điều trị bằng các loại tia đó (ví dụ: máy Coban Điều trị ung thư, máy gia tốc tuyến tính Điều trị ung thư, dao mổ gamma các loại, thiết bị xạ trị áp sát;...)';
            case 'thiet_bi_su_dung_tia_alpha_beta_hay_gamma_dung_cho_muc_dich_y_hoc_phau_thuat_nha_khoa_ke_ca_thiet_bi_chup_hoac_thiet_bi_dieu_tri_bang_cac_loai_tia_do_vi_du_may_coban_dieu_tri_ung_thu_may_gia_toc_tuyen_tinh_dieu_tri_ung_thu_dao_mo_gamma_cac_loai_thiet_bi_xa_tri_ap_sat': return 'Thiết bị sử dụng tia alpha, beta hay gamma dùng cho Mục đích y học, phẫu thuật, nha khoa kể cả thiết bị chụp hoặc thiết bị Điều trị bằng các loại tia đó (ví dụ: máy Coban Điều trị ung thư, máy gia tốc tuyến tính Điều trị ung thư, dao mổ gamma các loại, thiết bị xạ trị áp sát;...)';
            case 'thiet_bi_chan_doan_bang_dong_vi_phong_xa_he_thong_pet_spect_thiet_bi_do_do_tap_trung_iot_i130_i131': return 'Thiết bị chẩn đoán bằng đồng vị phóng xạ (hệ thống PET, SPECT, thiết bị đo độ tập trung iốt I130, I131)';
            case 'nhiet_ke_dien_tu': return 'Nhiệt kế điện tử';
            case 'nhiet_ke_y_hoc_thuy_ngan': return 'Nhiệt kế y học thủy ngân';
            case 'thiet_bi_phan_tich_ly_hoac_hoa_hoc_hoat_dong_bang_dien_dung_cho_muc_dich_y_hoc_vi_du_may_phan_tich_sinh_hoa_may_phan_tich_dien_giai_khi_mau_may_phan_tich_huyet_hoc_may_do_dong_mau_may_do_toc_do_mau_lang_he_thong_xet_nghiem_elisa_may_phan_tich_nhom_mau_may_chiet_tach_te_bao_may_do_ngung_tap_va_phan_tich_chuc_nang_tieu_cau_may_dinh_danh_vi_rut_vi_khuan_may_phan_tich_mien_dich_may_do_tai_luong_vi_khuan_vi_rut_may_do_duong_huyet_': return 'Thiết bị phân tích lý hoặc hóa học hoạt động bằng điện dùng cho Mục đích y học (ví dụ: máy phân tích sinh hóa; máy phân tích điện giải, khí máu; máy phân tích huyết học; máy đo đông máu; máy đo tốc độ máu lắng; hệ thống xét nghiệm elisa; máy phân tích nhóm máu; máy chiết tách tế bào; máy đo ngưng tập và phân tích chức năng tiểu cầu; máy định danh vi rút, vi khuẩn; máy phân tích miễn dịch; máy đo tải lượng vi khuẩn, vi rút; máy đo đường huyết...)';
            case 'ghe_nha_khoa_va_cac_bo_phan_cua_chung': return 'Ghế nha khoa và các bộ phận của chúng';
            case 'ghe_ve_sinh_danh_cho_nguoi_benh': return 'Ghế vệ sinh dành cho người bệnh';
            case 'den_mo_treo_tran': return 'Đèn mổ treo trần';
            case 'den_mo_de_ban_giuong': return 'Đèn mổ để bàn, giường';
            case 'den_kham': return 'Đèn khám';
            default: return 'Đèn phẫu thuật';
        }
    }
    
    public static function getLCB($hsl){
        return 1390000*$hsl;
    }
    
    public static function getLPC($hspc){
        return 1390000*$hspc;
    }
    
    public static function getHSL($cv, $bl){
        switch ($cv){
            case 'quan_ly_benh_vien': case 'hanh_chinh_tong_hop':case 'bac_si_chuyen_khoa_kham_va_dieu_tri':case 'bac_si_ky_thuat_cls': case 'bac_si_cap_cuu':
                switch ($bl){
                    case 1: return 6.02; case 2: return 6.56; case 3: return 6.92; case 4: return 7.28; case 5: return 7.64; case 6: return 8;
                }
                break;
            case 'tiep_don_cc': case 'tiep_don_kham_benh': case 'phat_thuoc': case 'ky_thuat_y_te':
                switch ($bl){
                    case 1: return 4.4; case 2: return 4.74; case 3: return 5.08; case 4: return 5.42; case 5: return 5.76; case 6: return 6.1;case 7: return 6.44; case 8: return 6.78;
                }
                break;
            case 'ke_toan': case 'ky_thuat_dien':
                switch ($bl){
                    case 1: return 4; case 2: return 4.34; case 3: return 4.68; case 4: return 5.02; case 5: return 5.36; case 6: return 5.7;case 7: return 6.04; case 8: return 6.38;
                }
                break;
            default:
                switch ($bl){
                    case 1: return 2.34; case 2: return 2.67; case 3: return 3; case 4: return 3.33; case 5: return 3.66; case 6: return 3.99;case 7: return 4.32; case 8: return 4.65;case 9: return 4.98;
                }
                break;
            								
        }
    }
    
}
