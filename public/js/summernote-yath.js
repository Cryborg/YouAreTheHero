/**
 * YouAreTheHero custom buttons for Summernote editor
 */
(function (factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(window.jQuery);
    }
}(function ($) {
    $.extend(true, $.summernote.lang, {
        'en-US': {
            yath: {
                add_custom_data_tooltip: 'Add custom data',
                button_label: 'Functions',
                function_genre_help: 'Display according to the genre of the character',
                function_if_help: 'Condition',
                function_random_help: 'Random string or integer',
                function_reverse_help: 'Reverse text',
                function_stutter_help: 'Make a character stutter',
            }
        },
        'fr-FR': {
            yath: {
                add_custom_data_tooltip: 'Ajoute des variables',
                button_label: 'Fonctions',
                function_genre_help: 'Affichage d\'une phras en tenant compte du genre du personnage.',
                function_if_help: 'Ajout d\'une condition',
                function_random_help: 'Mot ou nombre aléatoire',
                function_reverse_help: 'Inverser les lettres d\'un mot',
                function_stutter_help: 'Faire bégayer un personnage',
            }        }
    });
    $.extend($.summernote.plugins, {

        'add-function-tags': function (context) {
            const self = this;
            const ui = $.summernote.ui;
            const options = context.options;
            const lang = options.langInfo;

            // Insert a tag
            self.generateBtn = function(tag, tooltip) {
                const char = tag.slice(0, 1).toUpperCase();

                return ui.button({
                    contents: '<'+tag+'>'+char+'</'+tag+'>',
                    tooltip: tooltip + ' <' + tag + '>',
                    className: 'note-add-function-tags-btn',
                    click: function (e) {
                        self.wrapInTag(tag);
                    }
                });
            };

            // Insert text
            self.insertFunction = function(label, tag, tooltip) {
                return ui.button({
                    contents: label,
                    tooltip: tooltip + '=> ' + tag,
                    className: 'note-add-function-tags-btn',
                    click: function (e) {
                        context.invoke("editor.insertText", tag);
                    }
                });
            };

            const f_genre = self.insertFunction('Genre', 'genre[male|female]', lang.yath.function_genre_help);
            const f_if = self.insertFunction('Condition', 'if[condition|true|false]', lang.yath.function_if_help);
            const f_random = self.insertFunction('Random', 'random[value1|value2|...]', lang.yath.function_random_help);
            const f_reverse = self.insertFunction('Reverse', 'reverse[word]', lang.yath.function_reverse_help);
            const f_stutter = self.insertFunction('Stutter', 'stutter[word]', lang.yath.function_stutter_help);


            context.memo('button.add-function-tags', function () {
                return ui.buttonGroup([
                    ui.button({
                        className: 'dropdown-toggle',
                        contents: lang.yath.button_label,
                        tooltip: lang.yath.add_custom_data_tooltip,
                        data: {
                            toggle: 'dropdown'
                        }
                    }),
                    ui.dropdown([
                        ui.buttonGroup({
                            className: 'note-add-function-tags-code',
                            children: [f_genre, f_if, f_random, f_reverse, f_stutter]
                        }),
                        ui.buttonGroup({
                            className: 'note-add-function-tags-other',
                            children: []
                        })
                    ])
                ]).render();
            });

            self.areDifferentBlockElements = function(startEl, endEl) {
                const startElDisplay = getComputedStyle(startEl, null).display;
                const endElDisplay = getComputedStyle(endEl, null).display;

                if(startElDisplay !== 'inline' && endElDisplay !== 'inline') {
                    console.log("Can't insert across two block elements.")
                    return true;
                }
                else {
                    return false;
                }
            };

            self.isSelectionParsable = function(startEl, endEl) {

                if(startEl.isSameNode(endEl)) {
                    return true;
                }
                if( self.areDifferentBlockElements(startEl, endEl)) {
                    return false;
                }
                // if they're not different block elements, then we need to check if they share a common block ancestor
                // could do this recursively, if we want to back farther up the node chain...
                const startElParent = startEl.parentElement;
                const endElParent = endEl.parentElement;
                if (startEl.isSameNode(endElParent)
                    || endEl.isSameNode(startElParent)
                    || startElParent.isSameNode(endElParent) )
                {
                    return true;
                }
                else
                    console.log("Unable to parse across so many nodes. Sorry!")
                return false;
            };

            self.wrapInTag = function (tag) {
                // from: https://github.com/summernote/summernote/pull/1919#issuecomment-304545919
                // https://github.com/summernote/summernote/pull/1919#issuecomment-304707418

                if (window.getSelection) {
                    const selection = window.getSelection(),
                        selected = (selection.rangeCount > 0) && selection.getRangeAt(0);

                    // Only wrap tag around selected text
                    if (selected.startOffset !== selected.endOffset) {

                        const range = selected.cloneRange();

                        const startParentElement = range.startContainer.parentElement;
                        const endParentElement = range.endContainer.parentElement;

                        // if the selection starts and ends different elements, we could be in trouble
                        if( ! startParentElement.isSameNode(endParentElement)) {
                            if ( ! self.isSelectionParsable(startParentElement, endParentElement)) {
                                return;
                            }
                        }

                        const newNode = document.createElement(tag);
                        // https://developer.mozilla.org/en-US/docs/Web/API/Range/surroundContents
                        // Parses inline nodes, but not block based nodes...blocks are handled above.
                        newNode.appendChild(range.extractContents());
                        range.insertNode(newNode)

                        // Restore the selections
                        range.selectNodeContents(newNode);
                        selection.removeAllRanges();
                        selection.addRange(range);
                    }
                }
            };
        }
    });
}));
