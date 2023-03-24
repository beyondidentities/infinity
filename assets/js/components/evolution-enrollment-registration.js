/**
 * infinity - evolution-enrollment-registration.js
 * @author Miquel Brazil
 */

export default () => ({
	Registration: {
		name: {
			first: null,
			middle: null,
			last: null,
			generation: null
		},
		dob: {
			month: null,
			day: null,
			year: null
		},
		phone: {
			area_code: null,
			prefix: null,
			line: null,
			service: null
		},
		email: null,
		session: null
	},
	action: null,
    init() {
		console.log('Initializing Registration Form...');
		this.action = 'register';
    },
    register() {
		console.log(this.$event);
		let registration = new FormData(this.$event.target);

        fetch('https://ncompass.loc/api/v0/connections/schedule', {
			method: 'POST',
			body: registration
		}).then(
			(response) => {
				if (response.ok) {
					this.action = 'verify';
					return response.json();
					//window.location.reload();
				}
			}
		).then(
			(data) => console.log(data)
		);
	},
	verify() {
		console.log('Verify Mobile Number', this.$event);
		let registration = new FormData(this.$event.target);

		fetch('https://ncompass.loc/api/v0/connections/schedule', {
			method: 'POST',
			body: registration
		}).then(
			(response) => {
				if (response.ok) {
					this.action = 'confirmation';
					return response.json();
					//window.location.reload();
				}
			}
		).then(
			(data) => console.log(data)
		);
	}
})
