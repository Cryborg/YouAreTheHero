// Delete a character_field
$(document).on('click touchstart keydown', '.deleteCharacterField', function () {
    var $this = $(this);
    var id = $this.closest('tr').data('fieldid');
    var loadingClass = 'spinner-grow text-danger';
    var defaultClass = $this.attr('class');

    if (!$this.hasClass('fa-spin')) {
        $this.attr('class', loadingClass);
    }

    $.get({
        url: route('field.delete', {field: id}),
        method: 'DELETE'
    })
        .done(function (result) {
            if (result.success) {
                $this.closest('tr').remove();

                checkPointsToShare(result.max);
            }

            if (result.type === 'confirm') {
                const $modal = $('#modalPopup');

                $modal.find('.modal-header').addClass('modal-header-error');
                $modal.find('.modal-title').html(result.texts.title);
                $modal.find('.modal-body').html(result.html);
                $modal.find('.btn-confirm')
                    .data('fieldid', id)
                    .attr('class', 'btn-confirm btn btn-success deleteFieldConfirmed')
                    .html(result.texts.button);

                $modal.modal();
            }
        })
        .always(function () {
            $this.attr('class', defaultClass);
        });
});

$(document).on('click touchstart keydown', '.deleteFieldConfirmed', function () {
    const $this = $(this);
    const fieldId = $this.data('fieldid');
    const $modal = $('#modalPopup');

    $.get({
        url: route('field.delete', {field: fieldId, force: true}),
        method: 'DELETE'
    })
        .done(function(result) {
            if (result.success) {
                $('#stats_story tr[data-fieldid="' + fieldId + '"]').remove();

                $modal.modal('hide');
            }
        });
});

$(document).on('click touchstart keydown', '.deleteLocation', function () {
    const $this = $(this);
    const locationId = $this.data('locationid');

    $.get({
        url: route('location.delete', {location: locationId}),
        method: 'DELETE'
    });
});

// Edit a character_field
$(document).on('click touchstart keydown', '.editCharacterField', function () {
    const $this = $(this);
    const $parent = $this.closest('tr');
    const id = $parent.data('fieldid');
    const loadingClass = 'spinner-grow';
    const defaultClass = $this.attr('class');

    if (!$this.hasClass('fa-spin')) {
        $this.attr('class', loadingClass);
    }

    $.post({
        url: route('field.store', {story: storyId}),
        data: {
            'id': id,
            'name': $parent.find('.fieldName').val(),
            'min_value': $parent.find('.fieldMinValue').val(),
            'max_value': $parent.find('.fieldMaxValue').val(),
            'start_value': $parent.find('.fieldStartValue').val(),
            'hidden': $parent.find('.fieldHidden').is(':checked') ? 1 : 0,
        }
    })
        .done(function (result) {
            if (result.success) {
                checkPointsToShare(result.max);
            }
        })
        .always(function () {
            $this.attr('class', defaultClass);
        });
});

// Delete a person
$(document).on('click touchstart keydown', '.deletePerson', function () {
    const $this = $(this);
    const id = $this.data('person_id');
    const loadingClass = 'spinner-grow text-danger';
    const defaultClass = $this.attr('class');

    if (!$this.hasClass('fa-spin')) {
        $this.attr('class', loadingClass);
    }

    $.get({
        url: route('story.person.delete', {story: storyId, person: id}),
        method: 'DELETE'
    })
        .done(function (result) {
            if (result.success) {
                $this.closest('tr').remove();
            }
        })
        .always(function () {
            $this.attr('class', defaultClass);
        });
});

$(document).on('click touchstart keydown', '.addField', function () {
    if (checkForm()) {
        $.post({
            url: route('field.store', {'story': storyId}),
            data: {
                'name': $('#name').val(),
                'hidden': $('#hidden_field').is(':checked') ? 1 : 0,
                'min_value': $('#min_value').val(),
                'max_value': $('#max_value').val(),
                'start_value': $('#start_value').val()
            }
        })
            .done(function (result) {
                if (result.success) {
                    var html = '<tr data-fieldid="' + result.field.id + '">' +
                        '<td><div>' + result.field.name + '</div></td>' +
                        '<td><div>' + result.field.min_value + '</div></td>' +
                        '<td><div>' + result.field.max_value + '</div></td>' +
                        '<td><div>' + result.field.start_value + '</div></td>' +
                        '<td class="text-center"><div><input type="checkbox" value="1" ' +
                            (result.field.hidden ? 'checked' : '') +
                        '></div></td>' +
                        '<td class="text-center"><div><span class="icon-trash text-danger clickable deleteCharacterField" data-field_id="' + result.field.id + '"></span></div></td>' +
                        '</tr>';
                    $('#stats_story').append(html);

                    $('#min_value').val('1');
                    $('#max_value').val('10');
                    $('#name').val('').focus();
                }

                checkPointsToShare(result.max);
            });
    }
});

$(document).on('click touchstart keydown', '.addPerson', function () {
    if (checkPerson()) {
        $.post({
            url: route('story.person.store', {'story': storyId}),
            data: {
                'first_name': $('#first_name').val(),
                'last_name': $('#last_name').val(),
                'role': $('#role').val(),
            }
        })
            .done(function (result) {
                if (result.success) {
                    var html = '<tr>' +
                        '<td><div>' + result.person.first_name + '</div></td>' +
                        '<td><div>' + result.person.last_name + '</div></td>' +
                        '<td><div>' + result.person.role + '</div></td>' +
                        '<td class="text-center"><div><span class="icon-trash text-danger deletePerson" data-person_id="' + result.person.id + '"></span></div></td>' +
                        '</tr>';
                    $('#people_story').append(html);

                    $('#first_name, #last_name, #role').val('');
                    $('#first_name').focus();
                }

                checkPointsToShare(result.max);
            });
    }
});

$(document).on('click touchstart keydown', "[name='character_genre']", function () {
    $('#has_character').prop('checked', true);
});

$(document).on('click touchstart keydown', '#has_stats', function () {
    if ($(this).is(':checked')) {
        $('.hasStats').show();
    } else {
        $('.hasStats').hide();
    }
});

$(document).on('click touchstart keydown', '#pills-sheet .form-check-input', function () {
    const id = $(this).attr('id');
    const value = $('#' + id).is(':checked');

    saveOption(id, value);
});

function refreshLocations() {
    const $block = $('.locations-block');
    let routeLocations = route('location.list', {story: storyId});

    $block.load(routeLocations);
}

function refreshEquipmentLists() {
    $.get({
        url: route('story.equipment', {story: storyId})
    })
        .done(function(html) {
            $('.slotsList').html(html.inputs);
            $('.slotsSelect').html(html.select);
        });
}

$(document).on('click touchstart keydown', '.deleteEquipmentConfirmed', function () {
    const equipmentId = $(this).data('equipmentid');
    const $modal = $('#modalPopup');

    $.get({
        url: route('equipment.delete', {equipment: equipmentId, force: true}),
        method: 'DELETE'
    })
        .done(function(result) {
            if (result.success) {
                refreshEquipmentLists();

                $modal.modal('hide');
            }
        });
});

$(document).on('click touchstart keydown', '.deleteEquipment', function () {
    const equipmentId = $(this).data('equipmentid');

    $.get({
        url: route('equipment.delete', {equipment: equipmentId}),
        method: 'DELETE'
    })
        .done(function(result) {

            if (result.type === 'confirm') {
                const $modal = $('#modalPopup');

                $modal.find('.modal-header').addClass('modal-header-error');
                $modal.find('.modal-title').html(result.texts.title);
                $modal.find('.modal-body').html(result.html);
                $modal.find('.btn-confirm')
                    .data('equipmentid', equipmentId)
                    .attr('class', 'btn-confirm btn btn-success deleteEquipmentConfirmed')
                    .html(result.texts.button);

                $modal.modal();
            }


            refreshEquipmentLists();
        });
});

$(document).on('click touchstart keydown', '.updateEquipment', function () {
    const equipmentId = $(this).data('equipmentid');
    const newEquipmentName = $('#equipment_' + equipmentId).val();

    if (newEquipmentName !== '') {
        $.post({
            url: route('equipment.update', {equipment: equipmentId}),
            data: {
                'slot': newEquipmentName,
            }
        })
            .done(function() {
                refreshEquipmentLists();
            });
    }
});

$(document).on('click touchstart keydown', '.addLocation', function () {
    $.post({
        url: route('location.store', {story: storyId}),
        data: {
            name: $('#new_location').val()
        }
    })
});

$(document).on('click touchstart keydown', '.updateLocation', function () {
    const locationId = $(this).data('locationid');
    const newLocationName = $('#location_' + locationId).val();

    if (newLocationName !== '') {
        $.post({
            url: route('location.update', {location: locationId}),
            data: {
                'name': newLocationName,
            }
        });
    }
});

$(document).on('click touchstart keydown', '.addEquipment', function () {
    const newEquipment = $('#new_equipment').val();

    if (newEquipment !== '') {
        $.post({
            url: route('story.equipment.store', {story: storyId}),
            data: {
                'slot': newEquipment,
            }
        })
            .done(function() {
                refreshEquipmentLists();
            });
    }
});

$("#currency_name").debounce("change", function() {
    saveOption('currency_name', $(this).val());
}, 500);

$("#currency_amount").debounce("change", function() {
    saveOption('currency_amount', $(this).val());
}, 500);

$("#inventory_slots").debounce("change", function() {
    saveOption('inventory_slots', $(this).val());
}, 500);

$("#points_to_share").debounce("change", function() {
    const $this = $(this);

    // Check if this exceeds the max
    if ($this.val() > $this.attr('max')) {
        $this.val($this.attr('max'));
    }

    saveOption('points_to_share', $this.val());
}, 1000);

function saveOption(id, value) {
    $.post({
        url: route('story.options.post', {'story': storyId}),
        data: {option: id, value: value}
    })
        .done(function(result) {
            if (result.max) {
                checkPointsToShare(result.max);
            }
        });
}

function checkPointsToShare(max) {
    if ($('#points_to_share').val() > max) {
        $('#points_to_share')
            .attr('max', max)
            .val(max);
    }
}

function checkForm() {
    let correct = true;

    // No field can be empty
    $('input.new_field').each(function () {
        if ($(this).val() === '') {
            correct = false;
            $(this).addClass('input-invalid');
        } else {
            $(this).removeClass('input-invalid');
        }
    });

    // Min value should be less than max value, or equal
    if ($('#max_value').val() < $('#min_value').val()) correct = false;

    return correct;
}

function checkPerson() {
    let correct = true;

    // No field can be empty
    $('input.new_person').each(function () {
        if ($(this).val() === '') {
            correct = false;
            $(this).addClass('input-invalid');
        } else {
            $(this).removeClass('input-invalid');
        }
    });

    return correct;
}

refreshEquipmentLists();
refreshLocations();
