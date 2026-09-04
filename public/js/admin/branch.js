document.addEventListener('DOMContentLoaded', function () {
    initScheduleRepeater();
});

function initScheduleRepeater() {
    var rowsContainer = document.getElementById('scheduleRows');
    var addButton = document.getElementById('addScheduleRow');
    var template = document.getElementById('scheduleRowTemplate');

    if (!rowsContainer || !addButton || !template) {
        return;
    }

    function reindexRows() {
        var rows = rowsContainer.querySelectorAll('.schedule-row');
        rows.forEach(function (row, index) {
            var daySelect = row.querySelector('.schedule-row__day');
            var levelSelect = row.querySelector('.schedule-row__level');
            var timeInputs = row.querySelectorAll('input[type="time"]');
            daySelect.name = 'schedule[' + index + '][day]';
            timeInputs[0].name = 'schedule[' + index + '][start]';
            timeInputs[1].name = 'schedule[' + index + '][end]';
            levelSelect.name = 'schedule[' + index + '][level]';
        });
    }

    addButton.addEventListener('click', function () {
        var fragment = template.content.cloneNode(true);
        rowsContainer.appendChild(fragment);
        reindexRows();
    });

    rowsContainer.addEventListener('click', function (event) {
        var removeButton = event.target.closest('.schedule-row__remove');
        if (!removeButton) {
            return;
        }
        removeButton.closest('.schedule-row').remove();
        reindexRows();
    });
}
