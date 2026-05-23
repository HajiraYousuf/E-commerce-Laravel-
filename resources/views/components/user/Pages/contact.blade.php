@extends('components.user.layouts.app')

@section('content')

<section class="bg-gray-50 dark:bg-black min-h-screen py-16">

    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10">

        <!-- LEFT INFO -->
        <div>
            <h1 class="text-4xl font-bold mb-4">Contact Us 📩</h1>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                We are here to help you. Send us a message anytime and we will respond quickly.
            </p>

            <div class="space-y-4 text-gray-600 dark:text-gray-300">
                <p>📍 Address: Hargeisa, Somaliland</p>
                <p>📞 Phone: +252 63 638210213</p>
                <p>📧 Email: hajira@shop123.com</p>
            </div>
        </div>

        <!-- RIGHT FORM -->
        <div class="bg-white dark:bg-gray-900 p-8 rounded-3xl shadow">

            <h2 class="text-2xl font-bold mb-6">Send Message</h2>

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                @csrf

                <input type="text" name="name" placeholder="Your Name"
                    class="w-full p-4 rounded-xl bg-gray-100 dark:bg-gray-800 border">

                <input type="email" name="email" placeholder="Your Email"
                    class="w-full p-4 rounded-xl bg-gray-100 dark:bg-gray-800 border">

                <input type="text" name="subject" placeholder="Subject"
                    class="w-full p-4 rounded-xl bg-gray-100 dark:bg-gray-800 border">

                <textarea name="message" rows="5" placeholder="Your Message"
                    class="w-full p-4 rounded-xl bg-gray-100 dark:bg-gray-800 border"></textarea>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold">
                    Send Message
                </button>

            </form>

        </div>

    </div>

</section>

@endsection