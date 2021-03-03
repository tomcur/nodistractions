<?php

/*
 * Get the (meta) information about a book on the page with the given id.
 */
function getInformation($id)
{
	$meta = get_post_meta($id);
	
	$information = array();
	
	if(isset($meta['title'][0]) && $meta['title'][0])
	{
		$information['title'] = $meta['title'][0];
	}
	
	if(isset($meta['publisher'][0]) && $meta['publisher'][0])
	{
		$information['publisher'] = $meta['publisher'][0];
	}
	
	if(isset($meta['publisher_url'][0]) && $meta['publisher_url'][0])
	{
		$information['publisher_url'] = $meta['publisher_url'][0];
	}
	
	if(isset($meta['isbn'][0]) && $meta['isbn'][0])
	{
		$information['isbn'] = $meta['isbn'][0];
	}
	
	if(isset($meta['short_text'][0]) && $meta['short_text'][0])
	{
		$information['short_text'] = apply_filters('the_title', $meta['short_text'][0]);
	}
    
    if(isset($meta['translations'][0]) && $meta['translations'][0])
	{
		$information['translations'] = $meta['translations'][0];
	}
	
	$information['permalink'] = get_page_link($id);
	
	$parent = wp_get_post_parent_id($id);
	if($parent && get_page_template_slug($parent) == "template-book.php")
	{
		$information['parent'] = getInformation($parent);
		
		// If short text was not set for this book, but the parent has a short text set,
		// then copy the short text from the parent.
		if(!isset($information['short_text']))
		{
			if(isset($information['parent']['short_text']))
			{
				$information['short_text'] = $information['parent']['short_text'];
			}
		}
	}
	
	return $information;
}

/*
 * Book shortcode information handler.
 */
function bookInformation($atts)
{
	global $post;

	$information = getInformation($post->ID);
	$infoText = "";
	
	$title = isset($information['title']) ? $information['title'] : "N/A";
	$publisher = isset($information['publisher']) ? $information['publisher'] : "N/A";
	$isbn = isset($information['isbn']) ? $information['isbn'] : "N/A";
	
	$publisher = isset($information['publisher_url']) ? "<a href=\"{$information['publisher_url']}\" target=\"_BLANK\">{$publisher}</a>" : $publisher;
	
    $translations = isset($information['translations']) ? explode(PHP_EOL, $information['translations']) : array();
    
	if(isset($information['parent']))
	{
		$parentInformation = $information['parent'];
		$parentTitle = isset($parentInformation['title']) ? $parentInformation['title'] : "N/A";
		$parentPublisher = isset($parentInformation['publisher']) ? $parentInformation['publisher'] : "N/A";
		$parentLink = $parentInformation['permalink'];
		
		$originalEdition = "<tr><td>".__('Original Edition', 'nodistractions').": </td><td><a href=\"{$parentLink}\">{$parentTitle}</a> ({$parentPublisher})</td></tr>";
	}
	else
	{
		$originalEdition = "";
	}
	
	if(isset($information['short_text']))
	{
		$infoText .= $information['short_text'];
	}
	
	$infoText .= "<table class=\"book-information\">
		<tr><td>".__('Title', 'nodistractions').": </td><td>{$title}</td></tr>
		<tr><td>".__('Publisher', 'nodistractions').": </td><td>{$publisher}</td></tr>
		<tr><td>".__('ISBN', 'nodistractions').": </td><td>{$isbn}</td></tr>
		{$originalEdition}
	</table>";


	$args = array(
		'post_parent' => $post->ID,
		'post_type'   => 'page', 
		'numberposts' => -1,
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	); 
	
	if(count($translations) > 0)
	{
		$infoText .= "<h3>".__('Translations', 'nodistractions')."</h3><ul>";
		
		foreach($translations as $translation)
		{
            if(strlen(trim($translation)) == 0)
            {
                continue;
            }
            
            $infoText .= "<li>";
            
            $translationTitlePublisherLink = explode("|", $translation);
            if(count($translationTitlePublisherLink) > 1)
            {
                $translationTitle = trim($translationTitlePublisherLink[0]);
                $translationPublisherLink = trim($translationTitlePublisherLink[1]);
                
                $lastChar = substr($translationTitle, -1);
                $period = in_array($lastChar, [".", "?", "!"]) ? "" : ".";
                
                $infoText .= "{$translationTitle}{$period} ";
            }
            else
            {
                $translationPublisherLink = trim($translationTitlePublisherLink[0]);
            }
            $translationPublisherLink = explode("\\", $translationPublisherLink);
            
            if(count($translationPublisherLink) > 1)
            {
                $translationPublisher = trim($translationPublisherLink[0]);
                $translationLink = trim($translationPublisherLink[1]);
                
                $lastChar = substr($translationPublisher, -1);
                $period = in_array($lastChar, [".", "?", "!"]) ? "" : ".";
                
                $infoText .= "<a href=\"{$translationLink}\" target=\"_BLANK\">{$translationPublisher}</a>{$period}";
            }
            else
            {
                $translationPublisher = trim($translationPublisherLink[0]);
                
                $lastChar = substr($translationPublisher, -1);
                $period = in_array($lastChar, [".", "?", "!"]) ? "" : ".";
                
                $infoText .= "{$translationPublisher}{$period}";
            }
            
            $infoText .= "</li>";
		}
		
		$infoText .= "</ul>";
	}

	return $infoText;
}
add_shortcode( 'info', 'bookInformation' );

?>