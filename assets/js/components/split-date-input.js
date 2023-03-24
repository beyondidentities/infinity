/**
 * infinity – split-date-input.js
 * @author Miquel Brazil
 */

export default () => ({
    Months: null,
	Days: null,
	Years: null,
    init() {
		// calculate all months for the year
		// calculate all days for a month
		// calculate all years of eligible participants
        this.Calendar = new Datepicker(this.$el.querySelector('#selectDocumentServiceDate'), {
            autohide: true
        });

        this.Calendar.pickerElement.addEventListener('click', function($input, e) {
            if (typeof e.target.dataset.date !== 'undefined') {
                let dateChangeEvent = new Event('dateChange');
                $input.dispatchEvent(dateChangeEvent);
            }
        }.bind(this.Calendar, this.Calendar.inputField));

        this.Calendar.inputField.addEventListener('dateChange', function(e) {
            e.target._x_model.set(e.target.value);
        })
    }
})
