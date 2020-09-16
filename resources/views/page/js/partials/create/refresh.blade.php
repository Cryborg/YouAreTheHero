function refreshPrerequisitesList() {
    $('.prerequisites_list').load(route('prerequisites.list', {'page': pageId}), function () {
        var count = $('.prerequisites_list').find('table tbody tr').length;
        var $badge = $('.badge_prerequisites_count');

        if (count === 0) {
            $badge.hide();
        } else {
            $badge.show();
            $badge.html(count);
        }
    });
}

function refreshActionsList() {
    $('.actions_list').load(route('actions.list', {'page': pageId}), function () {
        var count = $('.actions_list').find('table tbody tr').length;
        var $badge = $('.badge_triggers_count');

        if (count === 0) {
            $badge.hide();
        } else {
            $badge.show();
            $badge.html(count);
        }
    });
}

function refreshItemsList() {
    $('.items_list').load(route('page.items.list', {page: pageId}), function () {
        var count = $('.items_list').find('table tbody tr').length;
        var $badge = $('.badge_items_count');

        if (count === 0) {
            $badge.hide();
        } else {
            $badge.show();
            $badge.html(count);
        }
    });
}

function refreshModalItemsList()
{
    $('.items_select_list').load(route('items.list', {story: storyId, selectId: 'item_id'}));
}
