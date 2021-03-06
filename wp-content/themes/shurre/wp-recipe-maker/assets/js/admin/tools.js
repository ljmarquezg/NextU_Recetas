import '../../css/admin/tools.scss';

let action = false;
let posts = [];
let posts_total = 0;

function handle_posts() {
	var data = {
		action: 'wprm_' + action,
		security: wprm_temp_admin.nonce,
		posts: JSON.stringify(posts)
    };

	jQuery.post(wprm_temp_admin.ajax_url, data, function(out) {
		if (out.success) {
            posts = out.data.posts_left;
			update_progress_bar();

			if(posts.length > 0) {
				handle_posts();
			} else {
				jQuery('#wprm-tools-finished').show();
			}
		} else {
			window.location = out.data.redirect;
		}
	}, 'json');
}

function update_progress_bar() {
	var percentage = ( 1.0 - ( posts.length / posts_total ) ) * 100;
	jQuery('#wprm-tools-progress-bar').css('width', percentage + '%');
};

jQuery(document).ready(function($) {
	// Import Process
	if(typeof window.wprm_tools !== 'undefined') {
		action = wprm_tools.action;
		posts = wprm_tools.posts;
        posts_total = wprm_tools.posts.length;
		handle_posts();
	}
});
