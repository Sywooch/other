<?php

#
# Фотрирование КАПЧИ
#



class captcha_lib
{

        var $std;
        var $path_background = '';
        var $path_fonts      = '';

        /*-------------------------------------------------------------------------*/
        // Set capthca code in session
        /*-------------------------------------------------------------------------*/
        function set_capthca_code()
        {
                //-----------------------------------------
                // Create new string
                //-----------------------------------------

                mt_srand( (double) microtime() * 1000000 );
                $final_rand = md5( uniqid( mt_rand(), TRUE ) );
                mt_srand();

                for( $i = 0; $i < 5; $i++ )
                {
                        $captcha_string .= $final_rand{ mt_rand(0, 31) };
                }

                $captcha_string = str_replace('o', '0', $captcha_string);

                //-----------------------------------------
                // Add to the DB
                //-----------------------------------------

                $this->std->updateSession( $this->std->session_id, 'update', array('captcha' => $captcha_string) );

                //-----------------------------------------
                // Return string
                //-----------------------------------------

                return $captcha_string;
        }

        /*-------------------------------------------------------------------------*/
        // Captcha validate
        /*-------------------------------------------------------------------------*/

        function captcha_validate( $captcha_input )
        {
                //-----------------------------------------
                // INIT
                //-----------------------------------------

                $captcha_input = trim( strtolower($captcha_input) );

                //-----------------------------------------
                // Get the info from the DB
                //-----------------------------------------

                $captcha = $this->std->getValueSession( 'captcha' );

                if ( ! $captcha )
                {
                        return FALSE;
                }

                //-----------------------------------------
                // Check...
                //-----------------------------------------

                if ( $captcha != $captcha_input )
                {
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }

        /*-------------------------------------------------------------------------*/
        // Show GD created security image...
        /*-------------------------------------------------------------------------*/
        function captcha_show(  )
        {

                //-----------------------------------------
                // set captcha code
                //-----------------------------------------

                $content = $this->set_capthca_code();

                //-----------------------------------------
                // Is GD Available?
                //-----------------------------------------

                if ( !extension_loaded('gd') )
                {
                        exit();
                }

                //-----------------------------------------
                // INIT
                //-----------------------------------------

                $content       = '  '. preg_replace( "/(\w)/", "\\1 ", $content ) .' ';
                $tmp_x         = 130;
                $tmp_y         = 20;
                $image_x       = 200;
                $image_y       = 60;
                $circles       = 3;
                $continue_loop = TRUE;
                $_started      = FALSE;

                //-----------------------------------------
                // Get backgrounds and fonts...
                //-----------------------------------------

                $backgrounds = $this->get_backgrounds();

                //-----------------------------------------
                // Seed rand functions for PHP versions that don't
                //-----------------------------------------

                mt_srand( (double) microtime() * 1000000 );

                //-----------------------------------------
                // Got a background?
                //-----------------------------------------

                while ( $continue_loop )
                {
                        if ( is_array( $backgrounds ) AND count( $backgrounds ) )
                        {
                                $i = mt_rand(0, count( $backgrounds ) - 1 );

                                $background      = $backgrounds[ $i ];
                                $_file_extension = preg_replace( "#^.*\.(\w{2,4})$#is", "\\1", strtolower( $background ) );

                                switch( $_file_extension )
                                {
                                        case 'jpg':
                                        case 'jpe':
                                        case 'jpeg':
                                                    if ( ! function_exists('imagecreatefromjpeg') OR ! $im = @imagecreatefromjpeg($background) )
                                                    {
                                                            unset( $backgrounds[ $i ] );
                                                    }
                                                    else
                                                    {
                                                            $continue_loop = FALSE;
                                                            $_started      = TRUE;
                                                    }
                                                    break;
                                        case 'gif':
                                                    if ( ! function_exists('imagecreatefromgif') OR ! $im = @imagecreatefromgif($background) )
                                                    {
                                                            unset( $backgrounds[ $i ] );
                                                    }
                                                    else
                                                    {
                                                            $continue_loop = FALSE;
                                                            $_started      = TRUE;
                                                    }
                                                    break;
                                        case 'png':
                                                    if ( ! function_exists('imagecreatefrompng') OR ! $im = @imagecreatefrompng($background) )
                                                    {
                                                            unset( $backgrounds[ $i ] );
                                                    }
                                                    else
                                                    {
                                                            $continue_loop = FALSE;
                                                            $_started      = TRUE;
                                                    }
                                                    break;
                                }
                        }
                        else
                        {
                                $continue_loop = FALSE;
                        }
                }

                //-----------------------------------------
                // Continue with nice background image
                //-----------------------------------------

                $tmp         = imagecreatetruecolor($tmp_x  , $tmp_y  );
                $tmp2        = imagecreatetruecolor($image_x, $image_y);

                $white       = imagecolorallocate( $tmp, 255, 255, 255 );
                $black       = imagecolorallocate( $tmp, 0, 0, 0 );
                $grey        = imagecolorallocate( $tmp, 100, 100, 100 );
                $transparent = imagecolorallocate( $tmp2, 255, 255, 255 );
                $_white      = imagecolorallocate( $tmp2, 255, 255, 255 );

                imagefill($tmp , 0, 0, $white );
                imagefill($tmp2, 0, 0, $_white);

                $num         = strlen($content);
                $x_param     = 0;
                $y_param     = 0;

                for( $i = 0; $i < $num; $i++ )
                {
                        if ( $i > 0 )
                        {
                                $x_param += rand( 6, 12 );

                                if( $x_param + 18 > $image_x )
                                {
                                        $x_param -= ceil( $x_param + 18 - $image_x );
                                }
                        }

                        $y_param  = rand( 0, 5 );

                        $randomcolor = imagecolorallocate( $tmp, 0, 0, 0 );//imagecolorallocate( $tmp, rand(50,200), rand(50,200),rand(50,200) );

                        imagestring( $tmp, 5, $x_param + 1, $y_param + 1, $content{$i}, $grey );
                        imagestring( $tmp, 5, $x_param    , $y_param    , $content{$i}, $randomcolor );
                }

                imagecopyresized($tmp2, $tmp, 0, 0, 0, 0, $image_x, $image_y, $tmp_x, $tmp_y );

                $tmp2 = $this->create_wave( $tmp2, 10 );

                imagecolortransparent( $tmp2, $transparent );
                imagecopymerge( $im, $tmp2, 0, 0, 0, 0, $image_x, $image_y, 100 );

                imagedestroy($tmp);
                imagedestroy($tmp2);


                //-----------------------------------------
                // Blur?
                //-----------------------------------------

                if ( function_exists( 'imagefilter' ) )
                {
                        @imagefilter( $im, IMG_FILTER_GAUSSIAN_BLUR );
                }

                //-----------------------------------------
                // Render a border
                //-----------------------------------------

                $black = imagecolorallocate( $im, 0, 0, 0 );

                imageline( $im, 0, 0, $image_x, 0, $black );
                imageline( $im, 0, 0, 0, $image_y, $black );
                imageline( $im, $image_x - 1, 0, $image_x - 1, $image_y, $black );
                imageline( $im, 0, $image_y - 1, $image_x, $image_y - 1, $black );

                //-----------------------------------------
                // Show it!
                //-----------------------------------------

                @header( "Content-Type: image/jpeg" );

                imagejpeg( $im );
                imagedestroy( $im );

                exit();
        }

        /*-------------------------------------------------------------------------*/
        // Create wave effect for GD images...
        /*-------------------------------------------------------------------------*/

        function create_wave( $im, $wave=10 )
        {
                $_width  = imagesx( $im );
                $_height = imagesy( $im );

                $tmp = imagecreatetruecolor( $_width, $_height );

                $_direction = ( time() % 2 ) ? TRUE : FALSE;

                for ( $x = 0; $x < $_width; $x++ )
                {
                        for ( $y = 0 ; $y < $_height ; $y++ )
                        {
                                $xo = $wave * sin( 2 * 3.1415 * $y / 128 );
                                $yo = $wave * cos( 2 * 3.1415 * $x / 128 );

                                $_x = $x - $xo;
                                $_y = $y - $yo;

                                if ( ($_x > 0 AND $_x < $_width) AND ($_y > 0 AND $_y < $_height) )
                                {
                                        $index  = imagecolorat($im, $_x, $_y);
                                        $colors = imagecolorsforindex($im, $index);
                                        $color  = imagecolorresolve( $tmp, $colors['red'], $colors['green'], $colors['blue'] );
                                }
                                else
                                {
                                        $color = imagecolorresolve( $tmp, 255, 255, 255 );
                                }

                                imagesetpixel( $tmp, $x, $y, $color );
                        }
                }

                return $tmp;
        }

        /*-------------------------------------------------------------------------*/
        // Load up the backgrounds
        /*-------------------------------------------------------------------------*/

        function get_backgrounds()
        {
                //-----------------------------------------
                // INIT
                //-----------------------------------------

                $images = array();
                $_path  = $this->path_background;

                if ( $_dir = @opendir( $_path ) )
                {
                        while( false !== ( $_file = @readdir( $_dir ) ) )
                        {
                                if ( preg_match( "#\.(gif|jpeg|jpg|png)$#i", $_file ) )
                                {
                                        $images[] = $_path . '/' . $_file;
                                }
                        }
                }

                return $images;
        }

}

?>
