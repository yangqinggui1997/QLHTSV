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
    
    public static function ejectUnicode($str,$strSymbol='_',$case=MB_CASE_LOWER){// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
        try
        {
            $str=trim($str);
            if ($str==="") return "";
            $str =str_replace('"','',$str);
            $str =str_replace("'",'',$str);
            $str = comm_functions::stripUnicode($str);
            $str = mb_convert_case($str,$case,'utf-8');
            $str = preg_replace('/[\W|-]+/',$strSymbol,$str);
            return $str;
        }
        catch(\Exception $ex)
        {
            return $ex->getMessage();
        }
    }

    public static function stripUnicode($str){
        try
        {
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
            foreach($unicode as $khongdau => $codau) {
                $arr = explode("|", $codau);
                $str = str_replace($arr, $khongdau, $str);
            }
            return $str;
        }
        catch(\Exception $ex)
        {
            return $ex->getMessage();
        }
	
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
        try
        {
            return comm_functions::changeTitle(comm_functions::convertIndexToTextDT($dantoc));
        }
        catch(\Exception $ex)
        {
            return $ex->getMessage();
        }
    }
    
    public static function convertIndexToTextDT($dantoc){
        switch ($dantoc){
            case 0: return "Kinh";case 1: return 'Chăm';case 2: return 'Hoa';case 3: return 'Khơ me';case 4: return 'Bana';case 5: return 'Bru - Vân Kiều';case 6: return 'Brâu';case 7: return 'Bố Y';case 8: return 'Chu Ru';case 9: return 'Chăm';case 10: return 'Chơ Ro';case 11: return 'Chứt';case 12: return 'Co';case 13: return 'Cơ Ho';case 14: return 'Cơ Tu';case 15: return 'Cống';case 16: return 'Cờ Lao';case 17: return 'Dao';case 18: return 'Gia Rai';case 19: return 'Giáy';case 20: return 'Giẻ Triêng';case 21: return 'Hrê';case 22: return 'Hà Nhì';case 23: return 'H’Mông';case 24: return 'Kháng';case 25: return 'Khơ Mú';case 26: return 'La Chí';case 27: return 'La Ha';case 28: return 'La Hủ';case 29: return 'Lào';case 30: return 'Lô Lô';case 31: return 'Lự';case 32: return 'Mường';case 33: return 'Mạ';case 34: return 'Mảng';case 35: return 'M’Nông';case 36: return 'Ngái';case 37: return 'Nùng';case 38: return 'Phù Lá';case 39: return 'Pu Péo';case 40: return 'Pà Thẻn';case 41: return 'Ra Glai';case 42: return 'Rơ Măm';case 43: return 'Si La';case 44: return 'Sán Chay';case 45: return 'Sán Dìu';case 46: return 'Thái';case 47: return 'Thổ';case 48: return 'Tà Ôi';case 49: return 'Tày';case 50: return 'Xinh Mun';case 51: return 'Xơ Đăng';case 52: return 'X’Tiêng';case 53: return 'Ê Đê';default: return 'Ơ Đu';
        }
    }
    
    public static function BigRandomNumber($min, $max) {
        try
        {
            $difference   = bcadd(bcsub($max,$min),1);
            $rand_percent = bcdiv(mt_rand(), mt_getrandmax(), 8); // 0 - 1.0
            return bcadd($min, bcmul($difference, $rand_percent, 8), 0);
        }
        catch(\Exception $ex)
        {
            return $ex->getMessage();
        }
    }

    public static function decodeCV($chucvu){
        switch ($chucvu){
            case 'hieu_truong': return "Hiệu trưởng";case 'pho_hieu_truong': return 'Phó hiệu trưởng';case 'truong_khoa': return 'Trưởng khoa';case 'pho_truong_khoa': return 'Phó trưởng khoa';case 'truong_phong': return 'Trưởng phòng';case 'pho_truong_phong': return 'Phó trưởng phòng';case 'truong_bo_mon': return 'Trưởng bộ môn';default: return 'Phó trưởng bộ môn';
        }
    }
    
    public static function decodeChuyenMon($cm){
        switch ($cm){
            case 'cong_nghe_thong_tin': return 'Công nghệ thông tin';case 'he_thong_thong_tin': return "Hệ thống thông tin";case 'ky_thuat_phan_mem': return 'Kỹ thuật phần mềm';case 'khoa_hoc_may_tinh': return 'Khoa học máy tính';case 'kinh_te_tai_chinh': return 'Kinh tế tài chính';case 'quan_tri_kinh_doanh': return 'Quản trị kinh doanh';case 'quan_tri_to_chuc_doanh_nghiep': return 'Quản trị tổ chức - doanh nghiệp';case 'nong_nhiep_tai_nguyen_thien_nhien': return 'Nông nghiệp và tài nguyên thiên nhiên';case 'ky_thuat_cong_nghiep_moi_truong': return 'Kỹ thuật công nghiệp môi trường';case 'van_hoa_du_lich': return 'Văn hoá - Du lịch';case 'luat_chinh_tri': return 'Luật - Chính trị';default: return 'Sư phạm';
        }
    }
    
    public static function decodeHocVi($hv){
        switch ($hv){
            case 'giao_su': return "Giáo sư";case 'pho_giao_su': return 'Phó giáo sư';case 'pho_giao_su_ts': return 'Phó giáo sư - Tiến sĩ';case 'tien_si': return 'Tiến sĩ';case 'thac_si': return 'Thạc sĩ';case 'cu_nhan': return 'Cử nhân';case 'cao_dang': return 'Cao đẳng';case 'trung_cap': return 'Trung cấp'; default: return 'Dưới trung cấp';
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