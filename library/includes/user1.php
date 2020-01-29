<?php
$kw = '';

$sort = 'user';
$sortingoption = 'user';
$arrAgents = custom_list_authors( '',array(
    'kw' => $kw,
    'sort' => $sort,
) );
?>
<ul class="userlistings">
    <?php
    $totalpost_count = count( $arrAgents );
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
<!--						<a href="--><?php //echo get_author_posts_url( $value->ID );?><!--">-->
						<span style="float: right">
					<?php _e( 'Best Answers' );?> <b> <?php echo $value->sum_num; ?></b>  </span>
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
