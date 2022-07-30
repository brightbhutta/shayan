<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package 
 */
get_header(); ?>
<section id="project">
	<div class="container">
		<div class="row">
			<?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                     $args = array(
                           'posts_per_page' => 6,
                           'post_type'      => 'project', 
                           'post_status'    => 'publish',
                           'orderby'        => 'date',
                           'order'          => 'ASC',
                           'tax_query' => array(
                                        array(
                                            'taxonomy' => 'project_taxonomy',
                                            'field'    => 'slug' //can be set to ID
                                        )
                                    ),
                           'paged'          => $paged
                         ); 
                    $customPostQuery = new WP_Query($args);
                ?>
                    <?php
                        if($customPostQuery->have_posts() ): 
                            while($customPostQuery->have_posts()) :
                               $customPostQuery->the_post();
                                 global $post;
                            //$moreLink = '<a href="' . esc_url(get_permalink(get_the_id())) . '"> Read More...</a>';
                        ?>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="cbd-product">
                               <a href="<?php echo esc_url(get_permalink(get_the_id()));?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail(); ?>
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo wp_trim_words( get_the_content(), 13, '...' ); ?></p>
                                    <h5><?php echo esc_html_e('Explore', 'domain');?><i class="fa fa-angle-right"></i></h5>
                                </a>
                            </div>
                        </div>
                <?php endwhile;  endif; 
                 wp_reset_query(); ?>
                 <?php  function cpt_pagination($pages = '', $range = 2){
                    $showitems = ($range * 2)+1;
                    global $paged;
                    if(empty($paged)) $paged = 1;
                    if($pages == '')
                    {
                    global $wp_query;
                    $pages = $wp_query->max_num_pages;
                    if(!$pages)
                    {
                        $pages = 1;
                    }
                }
            if(1 != $pages)
                {
                echo "<nav aria-label='Page navigation example'><ul class='pagination'> <span>Page ".$paged." of ".$pages."</span>";
                if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
                if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
                for ($i=1; $i <= $pages; $i++)
                {
                    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                    {
                        echo ($paged == $i)? "<li class=\"page-item active\"><a class='page-link'>".$i."</a></li>":"<li class='page-item'> <a href='".get_pagenum_link($i)."' class=\"page-link\">".$i."</a></li>";
                    }
                }
                if ($paged < $pages && $showitems < $pages) echo " <li class='page-item'><a class='page-link' href=\"".get_pagenum_link($paged + 1)."\"><i class='fa fa-angle-double-left'></i></a></li>";
                if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo " <li class='page-item'><a class='page-link' href='".get_pagenum_link($pages)."'><i class='fa fa-angle-double-right'></i></a></li>";
                echo "</ul></nav>\n";
            }
            }
            if (function_exists("cpt_pagination")) {
               cpt_pagination($customPostQuery->max_num_pages);          
            } ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
