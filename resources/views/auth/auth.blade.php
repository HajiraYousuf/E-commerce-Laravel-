<x-layouts.guest>

<div id="container"
     class="relative w-[850px] h-[550px] bg-white border border-slate-200/50 rounded-3xl shadow-2xl overflow-hidden mx-auto mt-20 transition-all duration-700">

    <!-- LOGIN -->
    <div class="form-box login absolute right-0 w-1/2 h-full flex items-center justify-center p-10 bg-white transition-all duration-700 ">

        <form method="POST" action="{{ route('login') }}" class="w-full">
            @csrf

            <h1 class="text-3xl font-bold mb-4 text-center text-slate-900">Login</h1>
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-4 text-center">
                    🚫 {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                    @foreach ($errors->all() as $error)
                        <div>🚫 {{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="relative my-6">
                <input type="email" name="email" placeholder="Email"
                       class="w-full p-3 bg-slate-100 focus:bg-white focus:ring-2 focus:ring-blue-500 rounded-lg outline-none transition">
            </div>

            <div class="relative my-6">
                <input type="password" name="password" placeholder="Password"
                       class="w-full p-3 bg-slate-100 focus:bg-white focus:ring-2 focus:ring-blue-500 rounded-lg outline-none transition">
            </div>

            <button class="w-full h-12 bg-slate-800 hover:bg-blue-800 text-white rounded-lg font-semibold transition duration-300 hover:scale-[1.02]">
                Login
            </button>
        </form>
    </div>

    <!-- REGISTER -->
<div class="form-box register absolute left-0 w-1/2 h-full flex items-center justify-center p-10 bg-white transition-all duration-700 opacity-0 pointer-events-none">

    <form method="POST" action="{{ route('register') }}" class="w-full">
        @csrf

        <h1 class="text-3xl font-bold mb-4 text-center text-slate-900">Register</h1>
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-3">
                {{ $errors->first() }}
            </div>
        @endif
        <!-- Full Name -->
        <input type="text" name="name" placeholder="Full Name"
               class="w-full p-3 my-2 bg-slate-100 focus:bg-white focus:ring-2 focus:ring-blue-500 rounded-lg transition">

        <!-- Email -->
        <input type="email" name="email" placeholder="Email"
               class="w-full p-3 my-2 bg-slate-100 focus:bg-white focus:ring-2 focus:ring-blue-500 rounded-lg transition">

        <!-- Password -->
        <input type="password" name="password" placeholder="Password"
               class="w-full p-3 my-2 bg-slate-100 focus:bg-white focus:ring-2 focus:ring-blue-500 rounded-lg transition">

        <!-- Confirm Password -->
        <input type="password" name="password_confirmation" placeholder="Confirm Password"
               class="w-full p-3 my-2 bg-slate-100 focus:bg-white focus:ring-2 focus:ring-blue-500 rounded-lg transition">

        <button class="w-full h-12 bg-slate-800 hover:bg-blue-800 text-white rounded-lg font-semibold mt-3 transition duration-300 hover:scale-[1.02]">
            Register
        </button>
    </form>

</div>

    <!-- TOGGLE -->
    <div class="absolute w-full h-full z-20 pointer-events-none">

        <!-- BLUE PANEL (NAVY MODERN) -->
        <div id="overlay"
             class="absolute left-[-250%] w-[300%] h-full bg-gradient-to-b from-slate-800 via-slate-800 to-blue-800 rounded-[150px] transition-all duration-[1.5s]">
        </div>

        <!-- LEFT -->
        <div id="leftPanel"
             class="absolute left-0 w-1/2 h-full flex flex-col items-center justify-center text-white text-center transition-all duration-700">

            <h1 class="text-3xl font-bold">Hello, Welcome!</h1>
            <p class="my-4 text-slate-200">Don't have an account?</p>

            <button id="registerBtn"
                class="border border-white px-6 py-2 rounded-lg hover:bg-white hover:text-slate-900 transition duration-300 pointer-events-auto">
                Register
            </button>
        </div>

        <!-- RIGHT -->
        <div id="rightPanel"
             class="absolute right-[-50%] w-1/2 h-full flex flex-col items-center justify-center text-white text-center transition-all duration-700">

            <h1 class="text-3xl font-bold">Welcome Back!</h1>
            <p class="my-4 text-slate-200">Already have an account?</p>

            <button id="loginBtn"
                class="border border-white px-6 py-2 rounded-lg hover:bg-white hover:text-slate-900 transition duration-300 pointer-events-auto">
                Login
            </button>
        </div>

    </div>
</div>


<!-- SCRIPT (UNCHANGED) -->
<script>
    const container = document.getElementById('container');
const registerBtn = document.getElementById('registerBtn');
const loginBtn = document.getElementById('loginBtn');

const overlay = document.getElementById("overlay");
const loginBox = document.querySelector(".login");
const registerBox = document.querySelector(".register");
const rightPanel = document.getElementById("rightPanel");
const leftPanel = document.getElementById("leftPanel");

registerBtn.addEventListener("click", () => {

    container.classList.add("active");

    overlay.style.left = "50%";

    loginBox.classList.add("opacity-0", "pointer-events-none");

    registerBox.classList.remove("opacity-0", "pointer-events-none");

    rightPanel.style.right = "0";
    leftPanel.style.left = "-50%";
});

loginBtn.addEventListener("click", () => {

    container.classList.remove("active");

    overlay.style.left = "-250%";

    loginBox.classList.remove("opacity-0", "pointer-events-none");

    registerBox.classList.add("opacity-0", "pointer-events-none");

    rightPanel.style.right = "-50%";
    leftPanel.style.left = "0";
});
</script>
</x-layouts.guest>