<header class="w-full">
	<div class="h-28 bg-bicc-masthead bg-cover"></div>
	<div class="h-14 bg-blue-900 relative">
		<div class="bg-bicc-logo bg-contain absolute w-40 lg:w-52 h-40 lg:h-52 rounded-full left-[50%] top-[50%] -translate-x-1/2 -translate-y-1/2">&nbsp;</div>
	</div>
</header>

<main class="pb-20 lg:w-[1024px] grow mx-auto lg:shadow tracking-tight bg-white bg-hero-header bg-no-repeat bg-top bg-contain lg:border-x lg:border-slate-200">
	<div class="after:block after:pt-72 lg:h-[650px]">Hero Section</div>
	<section class="px-8 lg:px-44">
		<h1 class="font-black text-3xl lg:text-6xl tracking-tight mb-8">Compass Connections</h1>
		<p class="leading-relaxed">Compass Connections is a new program from the Beyond Identities Community Center that gives you access to resources and tools to help you become your best self...all on your mobile phone</p>
	</section>
	<div class="mt-20 px-8 bg-[url('/assets/inverted-pyramid-gradient.svg')] bg-bottom bg-cover bg-no-repeat after:block after:pt-24">
		<section class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:px-20 mb-16">
			<section class="p-6 rounded-xl border-2 border-slate-500 shadow-[0.5rem_0.5rem_0_rgba(0,0,0,0.25)] bg-white">
				<h1 class="text-xl font-extrabold pb-4">Stay Informed</h1>
				<p class="text-sm leading-relaxed">Get real time alerts about upcoming events, programs, and local news delivered right to your mobile phone empowering YOUTH with accurate information.</p>
			</section>
			<section class="p-6 rounded-xl border-2 border-slate-500 shadow-[0.5rem_0.5rem_0_rgba(0,0,0,0.25)] bg-white">
				<h1 class="text-xl font-extrabold pb-4">Get Support</h1>
				<p class="text-sm leading-relaxed">Appointment Reminders, real-time supportive services and a central point of contact for the resources and tools to empower YOUTH to become your best you.</p>
			</section>
			<section class="p-6 rounded-xl border-2 border-slate-500 shadow-[0.5rem_0.5rem_0_rgba(0,0,0,0.25)] bg-white">
				<h1 class="text-xl font-extrabold pb-4">Earn Rewards</h1>
				<p class="text-sm leading-relaxed">Membership has its privileges and Compass Connections offers you the chance to earn points for engaging in your success. Redeem points for dope prizes and swag.</p>
			</section>
		</section>
		<section class="lg:px-44 text-center">
			<h1 class="font-black text-4xl mb-6">Interested?</h1>
			<p class="leading-relaxed">Does Compass Connections sound like something you want to learn more about. Complete the Registration Form here to sign up for an upcoming Enrollment Session. We’ll give you more information about the program and walk you through the process of getting setup.</p>
		</section>
	</div>
	<section x-data="cmptEvolutionEnrollmentRegistrationForm" class="mt-20 px-8 lg:px-20">
		<template x-if="action==='register'">
			<form @submit.prevent="register">
				<input type="hidden" name="action" :value="action">
				<h1>A little bit about you...</h1>
				<div class="divide-y">
					<fieldset class="grid lg:grid-cols-[30%_auto] grid-row-2 lg:gap-x-4 py-4 lg:w-full">
						<legend class="contents"><span class="sm:max-lg:h-fit w-full bg-blue-400 md:bg-inherit rounded-md md:rounded-none py-1 px-2 md:p-0 mb-4 text-sm font-semibold">Name</span></legend>
						<div class="flex flex-row gap-4">
							<div class="flex-1">
								<input name="name[first]" type="text" x-model="Registration.name.first" class="max-w-lg block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs text-sm border-zinc-300 rounded-md"></input>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">First Name</label>
							</div>
							<div class="flex-1">
								<input name="name[middle]" type="text" x-model="Registration.name.middle" class="max-w-lg block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs text-sm border-zinc-300 rounded-md"></input>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">Middle Name</label>
							</div>
							<div class="flex-1">
								<input name="name[last]" type="text" x-model="Registration.name.last" class="max-w-lg block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs text-sm border-zinc-300 rounded-md"></input>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">Last Name</label>
							</div>

							<div x-data="" class="basis-20 flex-initial">
								<select name="name[generation]" x-model="Registration.name.generation" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full sm:max-w-xs text-sm border-zinc-300 rounded-md">
									<option value selected>&nbsp;</option>
									<option value="1">Sr.</option>
									<option value="2">II</option>
									<option value="3">Jr.</option>
									<option value="4">III</option>
									<option value="5">IV</option>
									<option value="6">V</option>
								</select>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">Suffix</label>
							</div>
						</div>
					</fieldset>

					<fieldset x-data class="grid lg:grid-cols-[30%_auto] grid-row-2 lg:gap-x-4 py-4 lg:w-full">
						<legend class="contents"><span class="sm:max-lg:h-fit w-full bg-blue-400 md:bg-inherit rounded-md md:rounded-none py-1 px-2 md:p-0 mb-4 text-sm font-semibold">Birthdate</span></legend>
						<div class="flex flex-row gap-4">
							<div class="flex-1">
								<select id="dob_month" name="dob[month]" x-model="Registration.dob.month" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full sm:max-w-xs text-sm border-zinc-300 rounded-md">
									<option value selected>&nbsp;</option>
									<?php foreach ([
										'January',
										'February',
										'March',
										'April',
										'May',
										'June',
										'July',
										'August',
										'September',
										'October',
										'November',
										'December',
									] as $m => $mm): ?>
										<option value="<?= $m+1 ?>"><?= str_pad($m+1, 2, '0', STR_PAD_LEFT) . ' - ' . $mm ?></option>
									<?php endforeach; ?>
								</select>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">Month</label>
							</div>
							<div class="flex-1">
								<select id="dob_day" name="dob[day]" x-model="Registration.dob.day" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full sm:max-w-xs text-sm border-zinc-300 rounded-md">
									<option value selected>&nbsp;</option>
									<?php foreach (range(1, 31) as $day): ?>
										<option value="<?= $day ?>"><?= str_pad($day, 2, '0', STR_PAD_LEFT) ?></option>
									<?php endforeach; ?>
								</select>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">Day</label>
							</div>
							<div class="flex-1">
							<select id="dob_year" name="dob[year]" x-model="Registration.dob.year" class="block focus:ring-indigo-500 focus:border-indigo-500 w-full text-sm border-zinc-300 rounded-md">
									<option value selected>&nbsp;</option>
									<?php foreach (array_reverse(range(1994, 2005)) as $year): ?>
										<option value="<?= $year ?>"><?= $year ?></option>
									<?php endforeach; ?>
								</select>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">Year</label>
							</div>
						</div>
					</fieldset>

					<fieldset class="grid lg:grid-cols-[30%_auto] grid-row-2 lg:gap-x-4 py-4 lg:w-full">
						<legend class="contents"><span class="sm:max-lg:h-fit w-full bg-blue-400 md:bg-inherit rounded-md md:rounded-none py-1 px-2 md:p-0 mb-4 text-sm font-semibold">Mobile Number</span></legend>
						<div class="flex flex-row gap-4">
							<div class="flex-1">
								<input name="[phone[area_code]" type="text" x-model="Registration.phone.area_code" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 text-sm border-zinc-300 rounded-md"></input>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">Area Code</label>
							</div>
							<div class="flex-1">
								<input name="phone[prefix]" type="text" x-model="Registration.phone.prefix" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 text-sm border-zinc-300 rounded-md"></input>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">Prefix</label>
							</div>
							<div class="flex-1">
								<input name="phone[line]" type="text" x-model="Registration.phone.line" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 text-sm border-zinc-300 rounded-md"></input>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">Line</label>
							</div>
							<div class="flex-1">
								<select name="phone[service]" x-model="Registration.phone.service" class="block focus:ring-indigo-500 focus:border-indigo-500 w-full text-sm border-zinc-300 rounded-md">
									<option value selected>&nbsp;</option>
									<?php foreach (['AT&T', 'Boost', 'Cricket', 'Mint', 'Metro', 'Spectrum', 'T-Mobile', 'Verizon', 'Visible'] as $service): ?>
										<option value="<?= $service ?>"><?= $service ?></option>
									<?php endforeach; ?>
								</select>
								<label class="block pt-1.5 px-1 text-xs text-slate-600">Service</label>
							</div>
						</div>
					</fieldset>

					<fieldset class="grid lg:grid-cols-[30%_auto] grid-row-2 lg:gap-x-4 py-4 lg:w-full">
						<legend class="contents"><span class="sm:max-lg:h-fit w-full bg-blue-400 md:bg-inherit rounded-md md:rounded-none py-1 px-2 md:p-0 mb-4 text-sm font-semibold">Email Address</span></legend>
						<div class="flex-1">
							<input name="email" type="text" x-model="Registration.email" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 text-sm border-zinc-300 rounded-md"></input>
							<label class="block pt-1.5 px-1 text-xs text-slate-600">Email Address</label>
						</div>
					</fieldset>

					<fieldset class="grid lg:grid-cols-[30%_auto] grid-row-2 lg:gap-x-4 py-4 lg:w-full">
						<legend class="contents"><span class="sm:max-lg:h-fit w-full bg-blue-400 md:bg-inherit rounded-md md:rounded-none py-1 px-2 md:p-0 mb-4 text-sm font-semibold">Enrollment Session</span></legend>
						<div class="flex-1">
							<select id="session" name="session" x-model="Registration.session" class="block focus:ring-indigo-500 focus:border-indigo-500 w-full text-sm border-zinc-300 rounded-md">
								<option value selected>&nbsp;</option>
								<?php foreach ($Sessions as $ts => $session): ?>
									<option value="<?= $ts ?>"><?= $session ?></option>
								<?php endforeach; ?>
							</select>
							<label class="block pt-1.5 px-1 text-xs text-slate-600">Enrollment Session</label>
						</div>
					</fieldset>
				</div>
				<div>
					<button>Submit Registration</button>
				</div>
			</form>
		</template>
		<template x-if="action==='verify'">
			<form @submit.prevent="verify">
				<input type="hidden" name="action" :value="action">
				<h1>Verify Your Mobile Number</h1>
				<p>Check your phone for further instructions to verify the mobile number you provided so that we can confirm your Enrollment Session.</p>
				<div>
					<input name="verification-code" type="text" class="max-w-lg block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs text-sm border-zinc-300 rounded-md"></input>
					<label class="block pt-1.5 px-1 text-xs text-slate-600">Verification Code</label>
				</div>
				<div>
					<button>Submit Verification Code</button>
				</div>
			</form>
		</template>
		<template x-if="action==='confirmation'">
			<section>
				<h1>Congratulations</h1>
				<h2>You've successfully registered for your Enrollment Session</h2>
				<p>We'll remind you about your appointment the day before. If you have any questions between now and then, just send us a text to {number}.</p>
			</section>
		</template>
	</section>
</main>

<footer class="pt-20 pb-10 bg-orange-500">
	<div class="grid grid-cols-3 lg:w-[1024px] mx-auto text-sm text-slate-200">
		<section class="grid grid-cols-4 pl-6">
			<div>F</div>
			<div>I</div>
			<div>T</div>
			<div>TT</div>
		</section>
		<section class="col-span-2 pr-6">
			<p>The Beyond Identities Community Center or BICC was established in 2004 as a place where youth in the Greater Cleveland-area, just like you — can come to discover, grow and be yourself. BICC is a safe space free from judgement, opinions and limitations. We provide you with resources and opportunities to live your best life today and plan for your best future tomorrow.</p>
		</section>
		<p class="mt-20 col-span-3 border-t pt-4 text-xs">Copyright 2023 - All Rights Reserved</p>
	</div>
</footer>
