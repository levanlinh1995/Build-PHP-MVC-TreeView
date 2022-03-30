$(document).ready(function () {
    // default: mode 1
    callAllTreeView();

    $('input[type=radio][name=mode]').change(function () {
        if (this.value == '1') {
            callAllTreeView();
        } else if (this.value == '2') {
            callTreeAjax();
        }
    });
});

// Functions
function callAllTreeView() {
    $.ajax({
        url: '/tree-entry',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            const html = renderAllTree(data);
            $('.tree-view').html(html);

            $(document).off('click', '.caret');
            $(document).on('click', '.caret', function () {
                $(this).toggleClass('caret-down');

                const parentEl = $(this).parent().closest('li');
                parentEl.find('.nested').first().toggleClass('active');
            });
        },
        error: function (request, error) {
            console.log('Request: ' + JSON.stringify(request));
        }
    });
}

function callTreeAjax() {
    $.ajax({
        url: '/root-tree-entry',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            const html = renderPartialTree(data);
            $('.tree-view').html(html);

            $(document).off('click', '.caret');
            $(document).on('click', '.caret', function () {
                const parentEl = $(this).parent().closest('li');
                const id = parentEl.data('id');

                getChildrenById(id, parentEl);
            });
        },
        error: function (request, error) {
            console.log('Request: ' + JSON.stringify(request));
        }
    });
}

function renderAllTree(tree) {
    return '<ul class="nested">' + tree.map(node =>
        '<li class="' + (node?.children?.length > 0 ? 'li-container' : '') + '">' +
        '<p class="' + (node?.children?.length > 0 ? 'caret' : 'leaf') + '">' + node.name + '</p>' +
        (node?.children?.length > 0 ? renderAllTree(node.children) : '') +
        '</li>').join('\n') +
        '</ul>';
}

function renderPartialTree(tree) {
    return '<ul class="nested">' + tree.map(node =>
        '<li class="' + (node?.has_children ? 'li-container' : '') + '" data-id="' + node.entry_id + '">' +
        '<p class="' + (node?.has_children ? 'caret' : 'leaf') + '">' + node.name + '</p>' +
        '</li>').join('\n') +
        '</ul>';
}

function getChildrenById(parentId, parentEl) {
    if (parentEl.hasClass('called')) {
        parentEl.find('.caret').first().toggleClass('caret-down');
        parentEl.find('.nested').first().toggleClass('active');
        return;
    }

    $.ajax({
        url: '/tree-entry/children/' + parentId,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            const html = renderPartialTree(data);
            parentEl.append(html);
            parentEl.addClass('called');

            parentEl.find('.caret').first().toggleClass('caret-down');
            parentEl.find('.nested').first().toggleClass('active');

        },
        error: function (request, error) {
            console.log('Request: ' + JSON.stringify(request));
        }
    });
}