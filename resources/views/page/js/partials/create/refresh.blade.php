function refreshPrerequisitesList() {
    $('.prerequisites_list').load(route('prerequisites.list', {'page': pageId}));
}

function refreshActionsList() {
    $('.actions_list').load(route('actions.list', {'page': pageId}));
}

function refreshItemsList() {
    $('.items_list').load(route('page.items.list', {page: pageId}));
}
