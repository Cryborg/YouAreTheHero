    var Ziggy = {
        namedRoutes: {"admin.auth.users.index":{"uri":"admin\/auth\/users","methods":["GET","HEAD"],"domain":null},"admin.auth.users.create":{"uri":"admin\/auth\/users\/create","methods":["GET","HEAD"],"domain":null},"admin.auth.users.store":{"uri":"admin\/auth\/users","methods":["POST"],"domain":null},"admin.auth.users.show":{"uri":"admin\/auth\/users\/{user}","methods":["GET","HEAD"],"domain":null},"admin.auth.users.edit":{"uri":"admin\/auth\/users\/{user}\/edit","methods":["GET","HEAD"],"domain":null},"admin.auth.users.update":{"uri":"admin\/auth\/users\/{user}","methods":["PUT","PATCH"],"domain":null},"admin.auth.users.destroy":{"uri":"admin\/auth\/users\/{user}","methods":["DELETE"],"domain":null},"admin.auth.roles.index":{"uri":"admin\/auth\/roles","methods":["GET","HEAD"],"domain":null},"admin.auth.roles.create":{"uri":"admin\/auth\/roles\/create","methods":["GET","HEAD"],"domain":null},"admin.auth.roles.store":{"uri":"admin\/auth\/roles","methods":["POST"],"domain":null},"admin.auth.roles.show":{"uri":"admin\/auth\/roles\/{role}","methods":["GET","HEAD"],"domain":null},"admin.auth.roles.edit":{"uri":"admin\/auth\/roles\/{role}\/edit","methods":["GET","HEAD"],"domain":null},"admin.auth.roles.update":{"uri":"admin\/auth\/roles\/{role}","methods":["PUT","PATCH"],"domain":null},"admin.auth.roles.destroy":{"uri":"admin\/auth\/roles\/{role}","methods":["DELETE"],"domain":null},"admin.auth.permissions.index":{"uri":"admin\/auth\/permissions","methods":["GET","HEAD"],"domain":null},"admin.auth.permissions.create":{"uri":"admin\/auth\/permissions\/create","methods":["GET","HEAD"],"domain":null},"admin.auth.permissions.store":{"uri":"admin\/auth\/permissions","methods":["POST"],"domain":null},"admin.auth.permissions.show":{"uri":"admin\/auth\/permissions\/{permission}","methods":["GET","HEAD"],"domain":null},"admin.auth.permissions.edit":{"uri":"admin\/auth\/permissions\/{permission}\/edit","methods":["GET","HEAD"],"domain":null},"admin.auth.permissions.update":{"uri":"admin\/auth\/permissions\/{permission}","methods":["PUT","PATCH"],"domain":null},"admin.auth.permissions.destroy":{"uri":"admin\/auth\/permissions\/{permission}","methods":["DELETE"],"domain":null},"admin.auth.menu.index":{"uri":"admin\/auth\/menu","methods":["GET","HEAD"],"domain":null},"admin.auth.menu.store":{"uri":"admin\/auth\/menu","methods":["POST"],"domain":null},"admin.auth.menu.show":{"uri":"admin\/auth\/menu\/{menu}","methods":["GET","HEAD"],"domain":null},"admin.auth.menu.edit":{"uri":"admin\/auth\/menu\/{menu}\/edit","methods":["GET","HEAD"],"domain":null},"admin.auth.menu.update":{"uri":"admin\/auth\/menu\/{menu}","methods":["PUT","PATCH"],"domain":null},"admin.auth.menu.destroy":{"uri":"admin\/auth\/menu\/{menu}","methods":["DELETE"],"domain":null},"admin.auth.logs.index":{"uri":"admin\/auth\/logs","methods":["GET","HEAD"],"domain":null},"admin.auth.logs.destroy":{"uri":"admin\/auth\/logs\/{log}","methods":["DELETE"],"domain":null},"admin.handle-form":{"uri":"admin\/_handle_form_","methods":["POST"],"domain":null},"admin.handle-action":{"uri":"admin\/_handle_action_","methods":["POST"],"domain":null},"admin.login":{"uri":"admin\/auth\/login","methods":["GET","HEAD"],"domain":null},"admin.logout":{"uri":"admin\/auth\/logout","methods":["GET","HEAD"],"domain":null},"admin.setting":{"uri":"admin\/auth\/setting","methods":["GET","HEAD"],"domain":null},"admin.home":{"uri":"admin","methods":["GET","HEAD"],"domain":null},"admin.stories.list":{"uri":"admin\/stories","methods":["GET","HEAD"],"domain":null},"admin.story.create":{"uri":"admin\/stories\/create","methods":["GET","HEAD"],"domain":null},"admin.story.store":{"uri":"admin\/story\/store","methods":["POST"],"domain":null},"admin.pages.list":{"uri":"admin\/stories\/{story}\/pages","methods":["GET","HEAD"],"domain":null},"admin.pages.create":{"uri":"admin\/stories\/{story}\/pages\/create","methods":["GET","HEAD"],"domain":null},"admin.story.edit":{"uri":"admin\/stories\/{id}\/edit","methods":["GET","HEAD"],"domain":null},"admin.story.update":{"uri":"admin\/stories\/{id}\/update","methods":["PUT"],"domain":null},"page.form":{"uri":"admin\/page\/get-form","methods":["GET","HEAD"],"domain":null},"admin.page.store":{"uri":"admin\/page\/store","methods":["POST"],"domain":null},"telescope-toolbar.baseJs":{"uri":"_tt\/assets\/base.js","methods":["GET","HEAD"],"domain":null},"telescope-toolbar.styling":{"uri":"_tt\/assets\/styling.css","methods":["GET","HEAD"],"domain":null},"telescope-toolbar.render":{"uri":"_tt\/render\/{token}","methods":["GET","HEAD"],"domain":null},"telescope-toolbar.show":{"uri":"_tt\/show\/{token}\/{tab?}","methods":["GET","HEAD"],"domain":null},"telescope":{"uri":"telescope\/{view?}","methods":["GET","HEAD"],"domain":null},"home":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"stories.list.draft":{"uri":"stories\/draft","methods":["GET","HEAD"],"domain":null},"stories.list":{"uri":"stories","methods":["GET","HEAD"],"domain":null},"stories.list.ajax":{"uri":"stories\/ajax_list","methods":["GET","HEAD"],"domain":null},"story.create.post":{"uri":"story\/create","methods":["POST"],"domain":null},"story.create":{"uri":"story\/create","methods":["GET","HEAD"],"domain":null},"story.inventory":{"uri":"story\/{story}\/inventory","methods":["GET","HEAD"],"domain":null},"story.sheet":{"uri":"story\/{story}\/sheet","methods":["GET","HEAD"],"domain":null},"story.choices":{"uri":"story\/{story}\/{page}\/choices","methods":["GET","HEAD"],"domain":null},"story.play":{"uri":"story\/{story}\/{page?}","methods":["GET","HEAD"],"domain":null},"story.ajax_action":{"uri":"story\/ajax_action","methods":["POST"],"domain":null},"page.edit":{"uri":"page\/{page}\/edit","methods":["GET","HEAD"],"domain":null},"page.edit.post":{"uri":"page\/{page}\/edit","methods":["POST"],"domain":null},"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"register":{"uri":"register","methods":["GET","HEAD"],"domain":null},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"password\/email","methods":["POST"],"domain":null},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"password\/reset","methods":["POST"],"domain":null},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"],"domain":null}},
        baseUrl: 'https://127.0.0.1:8001/',
        baseProtocol: 'https',
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