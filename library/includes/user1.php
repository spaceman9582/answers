<?php get_header(); ?>
<?php
$kw = '';
$sort = '';

$sort = sanitize_text_field( $_REQUEST['sort'] );
if ( isset( $_REQUEST['sort'] ) && $_REQUEST['sort'] == 'alpha' ) {
    $kw = sanitize_text_field( $_REQUEST['kw'] );
    if ( $kw == '' ) {$kw = 'a';}
}

$arrAgents = custom_list_authors( '',array(
    'kw' => $kw,
    'sort' => $sort,
) );
?>
<div id="content">

    <ul id="tab" class="clearfix">
        <?php
        $soption = '';
        if ( isset( $_REQUEST['sort'] ) ) {
            $soption = $_REQUEST['sort'];
        }
        ?>
        <li class="page_item <?php if ( $soption == 'all' || $soption == '' ) {echo 'current_page_item';}?>"><a href="<?php echo get_option( 'siteurl' );?>/?ptype=users&sort=all"><?php _e( 'All Users' );?></a></li>
        <li class="page_item <?php if ( $soption == 'popular' ) {echo 'current_page_item';}?>"><a href="<?php echo get_option( 'siteurl' );?>/?ptype=users&sort=popular"><?php _e( 'Popular' );?></a></li>
        <li class="page_item <?php if ( $soption == 'alpha' ) {echo 'current_page_item';}?>"><a href="<?php echo get_option( 'siteurl' );?>/?ptype=users&sort=alpha"><?php _e( 'Alphabetical' );?></a></li>
    </ul>



    <?php if ( isset( $_REQUEST['sort'] ) && $_REQUEST['sort'] == 'alpha' ) {
        ?>
        <ul class="alphabetical">
            <li <?php if ( $kw == 'a' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=a">A</a></li>
            <li <?php if ( $kw == 'b' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=b">B</a></li>
            <li <?php if ( $kw == 'c' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=c">C</a></li>
            <li <?php if ( $kw == 'd' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=d">D</a></li>
            <li <?php if ( $kw == 'e' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=e">E</a></li>
            <li <?php if ( $kw == 'f' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=f">F</a></li>
            <li <?php if ( $kw == 'g' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=g">G</a></li>
            <li <?php if ( $kw == 'h' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=h">H</a></li>
            <li <?php if ( $kw == 'i' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=i">I</a></li>
            <li <?php if ( $kw == 'j' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=j">J</a></li>
            <li <?php if ( $kw == 'k' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=k">K</a></li>
            <li <?php if ( $kw == 'l' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=l">L</a></li>
            <li <?php if ( $kw == 'm' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=m">M</a></li>
            <li <?php if ( $kw == 'n' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=n">N</a></li>
            <li <?php if ( $kw == 'o' ) { echo 'class="current"';}?>> <a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=o">O</a></li>
            <li <?php if ( $kw == 'p' ) { echo 'class="current"';}?>> <a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=p">P</a></li>
            <li <?php if ( $kw == 'q' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=q">Q</a></li>
            <li <?php if ( $kw == 'r' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=r">R</a></li>
            <li <?php if ( $kw == 's' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=s">S</a></li>
            <li <?php if ( $kw == 't' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=t">T</a></li>
            <li <?php if ( $kw == 'u' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=u">U</a></li>
            <li <?php if ( $kw == 'v' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=v">V</a></li>
            <li <?php if ( $kw == 'w' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=w">W</a></li>
            <li <?php if ( $kw == 'x' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=x">X</a></li>
            <li <?php if ( $kw == 'y' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=y">Y</a></li>
            <li <?php if ( $kw == 'z' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=users&sort=alpha&kw=z">Z</a></li>
        </ul>
    <?php }?>

    <ul class="userlistings">
        <?php
        if ( isset( $_REQUEST['sort'] ) && $_REQUEST['sort'] == 'alpha' ) {
            $kw = sanitize_text_field( $_REQUEST['kw'] );
            if ( $kw == '' ) {$kw = 'a';}
        }
        $sortingoption = '';
        if ( isset( $_REQUEST['sort'] ) && $_REQUEST['sort'] != '' ) :
            $sortingoption = sanitize_text_field( $_REQUEST['sort'] );
        endif;
        $totalpost_count = custom_list_authors_count( '',array(
            'kw' => $kw,
            'sort' => $sortingoption,
        ) );
        $num_page = get_option( 'posts_per_page' );
        $tpages = round( $totalpost_count / $num_page );
        if ( count( $arrAgents ) > 0 ) {
            foreach ( $arrAgents as $key => $value ) {
                $userDetail = get_user_meta( $value->ID,'user_address_info' );
                ?>
                <li>
                    <?php get_user_profile_pic( $value->ID,100,100 ); ?>
                    <h3><span class="fl"> <a href="<?php echo get_author_posts_url( $value->ID );?>"><?php echo $value->display_name;?></a> </span>

                        <span class="total">
						<a href="<?php echo get_author_posts_url( $value->ID );?>">
					<?php _e( 'Questions Asked' );?> <b> <?php echo get_usernumposts_count( $value->ID ); ?></b>  </a>
						 </span>
                        <span class="total_point">

										<?php
                                        if ( users_comments( $value->ID ) ) {
                                            ?>
                                            <?php
                                            $creditlink = '';
                                            if ( strstr( get_author_posts_url( $value->ID ),'?' ) ) {
                                                $creditlink = get_author_posts_url( $value->ID ) . '&answered=1';
                                            } else {
                                                $creditlink = get_author_posts_url( $value->ID ) . '?answered=1';
                                            }
                                            ?>
                                            <a href="<?php echo get_option( 'siteurl' );?>/?ptype=author_answers&uid=<?php echo $value->ID;?>">
				<?php
                echo __( 'Answers Provided&nbsp;' ) . '<b>' . users_comments( $value->ID ) . '</b>&nbsp;&nbsp;';
                ?>
				</a>
                                            <?php
                                        }
                                        ?>
						   </span>





                    </h3>


                    <p class="agentlinks">
                        <?php if ( $value->user_url ) { ?>
                            <span><a href="<?php echo $value->user_url; ?>"><?php _e( "Visit User's Website" );?></a> </span>
                        <?php } ?>
                        <?php if ( @$value->user_twitter ) { ?>
                            <span><a href="<?php echo $value->user_url; ?>">| <?php _e( 'Twitter' );?></a>   </span>
                        <?php } ?>   |

                        <?php
                        if ( get_user_points( $value->ID ) ) {
                            ?>
                            <?php
                            $creditlink = '';
                            if ( strstr( get_author_posts_url( $value->ID ),'?' ) ) {
                                $creditlink = get_author_posts_url( $value->ID ) . '&points=1';
                            } else {
                                $creditlink = get_author_posts_url( $value->ID ) . '?points=1';
                            }
                            ?>

                            <?php echo __( '<b>' ) . get_user_points( $value->ID ) . __( '</b>  - Votes Received&nbsp;&nbsp;' );?>

                            <?php
                        }
                        ?>

                    </p>
                    <p><?php
                        $user_description = get_user_meta( $value->ID,'user_description' );
                        if ( $user_description = '' ) :
                            $user_description = '';
                        endif;
                        if ( strlen( $user_description ) > 170 ) { echo substr( $user_description,0,170 ) . ' ...';
                        } else { echo $user_description;}?> </p>

                    <?php
                    if ( get_option( 'ptthemes_user_email_flag' ) == '' ) {
                    ?>
                    <p class="links"><?php _e( 'E-mail : ' );
                        echo $value->user_email;?>
                        <?php }?>

                        <span class="fr profile" ><a href="<?php echo get_author_posts_url( $value->ID );?>"  class="" ><?php _e( 'View Profile &raquo;' );?></a></span>


                    </p>
                </li>
                <?php
            }// End foreach().
        } else {
            ?>
            <p class="ac"><?php _e( '<b>No User available for this match, name begin with ' );?>"<?php echo strtoupper( $kw );?></b>"</p>
            <?php
        }// End if().
        ?>
    </ul>

    <!-- Pagination -->
    <?php if ( count( $arrAgents ) > 0 ) {?>
        <div class="pagination">
            <?php if ( function_exists( 'wp_pagenavi' ) ) { ?><?php wp_pagenavi( $before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = $tpages, $always_show = false ); ?><?php } ?>
        </div>
    <?php }?>

</div> <!-- content #end -->

<div id="sidebar" class="sidebar_spacer" >

    <?php include( TEMPLATEPATH . '/library/includes/ask_question_button.php' );?>

    <?php dynamic_sidebar( 2 );  ?>


</div> <!-- sidebar #end -->

<?php get_footer(); ?>
