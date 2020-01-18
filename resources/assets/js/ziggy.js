    var Ziggy = {
        namedRoutes: {"telescope-toolbar.baseJs":{"uri":"_tt\/assets\/base.js","methods":["GET","HEAD"],"domain":null},"telescope-toolbar.styling":{"uri":"_tt\/assets\/styling.css","methods":["GET","HEAD"],"domain":null},"telescope-toolbar.render":{"uri":"_tt\/render\/{token}","methods":["GET","HEAD"],"domain":null},"telescope-toolbar.show":{"uri":"_tt\/show\/{token}\/{tab?}","methods":["GET","HEAD"],"domain":null},"telescope":{"uri":"telescope\/{view?}","methods":["GET","HEAD"],"domain":null},"home":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"item.store":{"uri":"item\/create","methods":["POST"],"domain":null},"stories.list.draft":{"uri":"stories\/draft","methods":["GET","HEAD"],"domain":null},"stories.list":{"uri":"stories","methods":["GET","HEAD"],"domain":null},"stories.list.ajax":{"uri":"stories\/ajax_list","methods":["GET","HEAD"],"domain":null},"story.reset":{"uri":"story\/{story}\/reset","methods":["GET","HEAD"],"domain":null},"story.create":{"uri":"story\/create","methods":["GET","HEAD"],"domain":null},"story.create.post":{"uri":"story\/create","methods":["POST"],"domain":null},"story.edit":{"uri":"story\/{story}\/edit","methods":["GET","HEAD"],"domain":null},"story.tree":{"uri":"story\/{story}\/tree","methods":["GET","HEAD"],"domain":null},"story.inventory":{"uri":"story\/{story}\/inventory","methods":["GET","HEAD"],"domain":null},"story.sheet":{"uri":"story\/{story}\/sheet","methods":["GET","HEAD"],"domain":null},"page.create":{"uri":"story\/{story}\/page\/create\/{page?}","methods":["GET","HEAD"],"domain":null},"story.choices":{"uri":"story\/{story}\/{page}\/choices","methods":["GET","HEAD"],"domain":null},"story.play":{"uri":"story\/{story}\/{page?}","methods":["GET","HEAD"],"domain":null},"story.ajax_action":{"uri":"story\/ajax_action","methods":["POST"],"domain":null},"story.ajax_getitem":{"uri":"story\/ajax_get_item","methods":["POST"],"domain":null},"story.ajax_postchildrenpages":{"uri":"story\/ajax_post_children_pages","methods":["POST"],"domain":null},"page.edit":{"uri":"page\/{page}\/edit","methods":["GET","HEAD"],"domain":null},"page.edit.post":{"uri":"page\/{page}\/edit","methods":["POST"],"domain":null},"actions.list":{"uri":"actions\/{page}\/list","methods":["GET","HEAD"],"domain":null},"actions.store":{"uri":"actions\/create\/{page}","methods":["POST"],"domain":null},"actions.delete":{"uri":"actions\/{action}\/delete","methods":["DELETE"],"domain":null},"prerequisite.store":{"uri":"prerequisite\/store\/{page}","methods":["POST"],"domain":null},"prerequisite.delete":{"uri":"prerequisite\/{prerequisite}\/delete","methods":["DELETE"],"domain":null},"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"register":{"uri":"register","methods":["GET","HEAD"],"domain":null},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"password\/email","methods":["POST"],"domain":null},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"password\/reset","methods":["POST"],"domain":null},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"],"domain":null},"character.create":{"uri":"character\/create\/{story}","methods":["GET","HEAD"],"domain":null},"character.create.post":{"uri":"character\/create\/{story}","methods":["POST"],"domain":null},"language":{"uri":"language\/{lang}","methods":["GET","HEAD"],"domain":null},"stat.store":{"uri":"stat\/{story}\/create","methods":["POST"],"domain":null},"stat.delete":{"uri":"stat\/{stat_story}\/delete","methods":["DELETE"],"domain":null}},
        baseUrl: 'http://127.0.0.1:8001/',
        baseProtocol: 'http',
        baseDomain: '127.0.0.1',
        basePort: 8001,
        defaultParameters: []
    };

    if (typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
