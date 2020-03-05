UPDATE wclp19_options SET option_value = REPLACE(option_value, 'https://weclip.nl', 'https://www.weclip.nl') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wclp19_posts SET post_content = REPLACE (post_content, 'https://weclip.nl', 'https://www.weclip.nl');
UPDATE wclp19_posts SET post_excerpt = REPLACE (post_excerpt, 'https://weclip.nl', 'https://www.weclip.nl');
UPDATE wclp19_postmeta SET meta_value = REPLACE (meta_value, 'https://weclip.nl','https://www.weclip.nl');
UPDATE wclp19_termmeta SET meta_value = REPLACE (meta_value, 'https://weclip.nl','https://www.weclip.nl');
UPDATE wclp19_comments SET comment_content = REPLACE (comment_content, 'https://weclip.nl', 'https://www.weclip.nl');
UPDATE wclp19_comments SET comment_author_url = REPLACE (comment_author_url, 'https://weclip.nl','https://www.weclip.nl');
UPDATE wclp19_posts SET guid = REPLACE (guid, 'https://weclip.nl', 'https://www.weclip.nl') WHERE post_type = 'attachment';