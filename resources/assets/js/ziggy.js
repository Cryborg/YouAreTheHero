    var Ziggy = {
        namedRoutes: {"telescope-toolbar.baseJs":{"uri":"_tt\/assets\/base.js","methods":["GET","HEAD"],"domain":null},"telescope-toolbar.styling":{"uri":"_tt\/assets\/styling.css","methods":["GET","HEAD"],"domain":null},"telescope-toolbar.render":{"uri":"_tt\/render\/{token}","methods":["GET","HEAD"],"domain":null},"telescope-toolbar.show":{"uri":"_tt\/show\/{token}\/{tab?}","methods":["GET","HEAD"],"domain":null},"telescope":{"uri":"telescope\/{view?}","methods":["GET","HEAD"],"domain":null},"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"register":{"uri":"register","methods":["GET","HEAD"],"domain":null},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"password\/email","methods":["POST"],"domain":null},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"password\/reset","methods":["POST"],"domain":null},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"],"domain":null},"google.auth":{"uri":"redirect","methods":["GET","HEAD"],"domain":null},"language":{"uri":"language\/{lang}","methods":["GET","HEAD"],"domain":null},"story.play.anonymous":{"uri":"story\/anonymous","methods":["GET","HEAD"],"domain":null},"home":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"item.store":{"uri":"item\/create","methods":["POST"],"domain":null},"item.take":{"uri":"item\/{item}\/{page}\/take","methods":["GET","HEAD"],"domain":null},"items.html.list":{"uri":"items\/{story}\/html_list","methods":["GET","HEAD"],"domain":null},"item.throw_away":{"uri":"item\/{character_item}\/throw","methods":["GET","HEAD"],"domain":null},"item.use":{"uri":"item\/{character}\/{item}\/use","methods":["GET","HEAD"],"domain":null},"item.delete":{"uri":"item\/{item}\/delete","methods":["DELETE"],"domain":null},"item.details":{"uri":"item\/{item}\/details","methods":["GET","HEAD"],"domain":null},"stories.list.draft":{"uri":"stories\/draft","methods":["GET","HEAD"],"domain":null},"stories.list":{"uri":"stories","methods":["GET","HEAD"],"domain":null},"story.reset":{"uri":"story\/{story}\/reset\/{play?}","methods":["GET","HEAD"],"domain":null},"story.create":{"uri":"story\/create","methods":["GET","HEAD"],"domain":null},"story.create.post":{"uri":"story\/create","methods":["POST"],"domain":null},"story.edit":{"uri":"story\/{story}\/edit","methods":["GET","HEAD"],"domain":null},"story.inventory":{"uri":"story\/{story}\/inventory","methods":["GET","HEAD"],"domain":null},"story.sheet":{"uri":"story\/{story}\/sheet","methods":["GET","HEAD"],"domain":null},"page.create":{"uri":"story\/{story}\/page\/create\/{page?}","methods":["POST"],"domain":null},"story.has_errors":{"uri":"story\/{story}\/has_errors","methods":["GET","HEAD"],"domain":null},"story.play":{"uri":"story\/{story}\/{page?}","methods":["GET","HEAD"],"domain":null},"story.ajax_postchildrenpages":{"uri":"story\/ajax_post_children_pages","methods":["POST"],"domain":null},"story.options.post":{"uri":"story\/{story}\/options","methods":["POST"],"domain":null},"story.delete":{"uri":"story\/{story}\/delete","methods":["DELETE"],"domain":null},"items.list":{"uri":"story\/{story}\/items\/list","methods":["GET","HEAD"],"domain":null},"items.modal.list":{"uri":"story\/{story}\/items\/modal","methods":["GET","HEAD"],"domain":null},"story.errors":{"uri":"story\/{story}\/errors\/list","methods":["GET","HEAD"],"domain":null},"page.edit":{"uri":"page\/{page}\/edit","methods":["GET","HEAD"],"domain":null},"page.list":{"uri":"page\/{story}\/list","methods":["GET","HEAD"],"domain":null},"page.choices":{"uri":"page\/{page}\/choices","methods":["GET","HEAD"],"domain":null},"page.choice":{"uri":"page\/{pageFrom}\/{pageTo}\/choice","methods":["GET","HEAD"],"domain":null},"page.items.list":{"uri":"page\/{page}\/items\/list","methods":["GET","HEAD"],"domain":null},"choice.update":{"uri":"page\/choice\/{choice}","methods":["POST"],"domain":null},"page.edit.post":{"uri":"page\/{page}\/edit","methods":["POST"],"domain":null},"page.riddle.validate":{"uri":"page\/{page}\/riddle","methods":["POST"],"domain":null},"page.item.store":{"uri":"page\/{page}\/item\/create","methods":["POST"],"domain":null},"page.delete":{"uri":"page\/{page}\/delete","methods":["DELETE"],"domain":null},"page.choice.delete":{"uri":"page\/{page}\/{page_from}\/delete","methods":["DELETE"],"domain":null},"page.item.delete":{"uri":"page\/{page}\/{item}\/item\/delete","methods":["DELETE"],"domain":null},"prerequisites.list":{"uri":"prerequisite\/{page}\/list","methods":["GET","HEAD"],"domain":null},"prerequisite.store":{"uri":"prerequisite\/store\/{page}","methods":["POST"],"domain":null},"prerequisite.delete":{"uri":"prerequisite\/{prerequisite}\/delete","methods":["DELETE"],"domain":null},"character.purse":{"uri":"character\/{character}\/purse","methods":["GET","HEAD"],"domain":null},"character.create":{"uri":"character\/create\/{story}","methods":["GET","HEAD"],"domain":null},"character.create.post":{"uri":"character\/create\/{story}","methods":["POST"],"domain":null},"field.store":{"uri":"field\/{story}\/create","methods":["POST"],"domain":null},"field.delete":{"uri":"field\/{field}\/delete","methods":["DELETE"],"domain":null},"changelog":{"uri":"changelog","methods":["GET","HEAD"],"domain":null},"admin":{"uri":"admin","methods":["GET","HEAD"],"domain":null},"admin.stories":{"uri":"admin\/stories","methods":["GET","HEAD"],"domain":null},"admin.users":{"uri":"admin\/users","methods":["GET","HEAD"],"domain":null},"admin.clear.cache":{"uri":"admin\/clear-cache","methods":["GET","HEAD"],"domain":null},"admin.clear.view":{"uri":"admin\/clear-view","methods":["GET","HEAD"],"domain":null},"user.profile":{"uri":"user\/profile","methods":["GET","HEAD"],"domain":null},"user.profile.get":{"uri":"user\/{user}\/profile","methods":["GET","HEAD"],"domain":null},"user.profile.post":{"uri":"user\/{user}\/profile","methods":["POST"],"domain":null},"riddle.store":{"uri":"page\/{page}\/newriddle","methods":["POST"],"domain":null},"descriptions.show_modal":{"uri":"description\/{page}","methods":["GET","HEAD"],"domain":null},"description.create":{"uri":"description\/{page}","methods":["POST"],"domain":null},"description.delete":{"uri":"description\/{description}\/delete","methods":["DELETE"],"domain":null},"action.field.create":{"uri":"action\/{page}\/field\/{field}\/create","methods":["POST"],"domain":null},"action.item.create":{"uri":"action\/{page}\/item\/create","methods":["POST"],"domain":null},"action.listjs":{"uri":"actions\/{page}","methods":["GET","HEAD"],"domain":null},"actions.list":{"uri":"actions\/{page}\/list","methods":["GET","HEAD"],"domain":null},"action.delete":{"uri":"action\/{action}\/delete","methods":["DELETE"],"domain":null},"report.store":{"uri":"report\/{page}\/create","methods":["POST"],"domain":null},"reports.list":{"uri":"reports\/{story}\/list","methods":["GET","HEAD"],"domain":null},"report.delete":{"uri":"report\/{report}\/delete","methods":["DELETE"],"domain":null},"mail.preview":{"uri":"mail\/{user}\/{mailable}\/preview","methods":["GET","HEAD"],"domain":null},"mail.send":{"uri":"mail\/{user}\/{mailable}\/send","methods":["POST"],"domain":null},"story.people.list":{"uri":"story\/{story}\/people\/list","methods":["GET","HEAD"],"domain":null},"story.person.store":{"uri":"story\/{story}\/person\/store","methods":["POST"],"domain":null},"story.person.delete":{"uri":"story\/{story}\/person\/{person}\/delete","methods":["DELETE"],"domain":null},"user.success.index":{"uri":"user\/{user}\/success","methods":["GET","HEAD"],"domain":null},"user.success.create":{"uri":"user\/{user}\/success\/create","methods":["GET","HEAD"],"domain":null},"user.success.store":{"uri":"user\/{user}\/success","methods":["POST"],"domain":null},"user.success.show":{"uri":"user\/{user}\/success\/{success}","methods":["GET","HEAD"],"domain":null},"user.success.edit":{"uri":"user\/{user}\/success\/{success}\/edit","methods":["GET","HEAD"],"domain":null},"user.success.update":{"uri":"user\/{user}\/success\/{success}","methods":["PUT","PATCH"],"domain":null},"user.success.destroy":{"uri":"user\/{user}\/success\/{success}","methods":["DELETE"],"domain":null}},
        baseUrl: 'https://local.hero.perso/',
        baseProtocol: 'https',
        baseDomain: 'local.hero.perso',
        basePort: false,
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
