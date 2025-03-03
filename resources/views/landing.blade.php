<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Npontu Learning Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-cyan-100">
    <header class="rounded bg-white shadow-md py-4 w-[85%] translate-x-[5rem]">
        <div class="container mx-auto flex justify-between items-center px-4">
            <img alt="Logo of NPONTU Learning Hub" class="h-12" src="{{ asset('images/sign_in_sign_up/logo_u45.svg') }}" />
            <div class="flex items-center justify-between space-x-4">
                <span>
                    <select class="translate-x-[-15rem] text-gray-600 w-[220px]">
                        <option value="" disabled selected>Brief overview of courses</option>
                        <option value="business-software-management">Business and Software Management</option>
                        <option value="software-engineering">Software Engineering</option>
                        <option value="programming-development">Programming and Development</option>
                        <option value="data-science-analytics">Data Science and Analytics</option>
                        <option value="cybersecurity">Cybersecurity</option>
                        <option value="database-management">Database Management</option>
                        <option value="devops">DevOps</option>
                        <option value="ai-ml">Artificial Intelligence and Machine Learning</option>
                        <option value="cloud-computing">Cloud Computing</option>
                        <option value="software-development">Software Development</option>
                    </select>
                </span>
                <span class="relative translate-x-[-5rem]">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input class="border rounded px-4 py-1 w-[20rem] pl-10" placeholder="Search" type="text" />
                </span>
                <a class="text-gray-600 text-center px-4 py-2 rounded-full hover:bg-gray-100 transition duration-200"
                    href="{{ route('login') }}">Log in</a>
                <a class="bg-cyan-400 text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-500 transition duration-200"
                    href="{{ route('register') }}">Sign up</a>
            </div>
        </div>
    </header>

    <main class="text-center py-16">
        <h1 class="text-3xl font-semibold text-gray-800 mb-[3rem]">Empower Your Workforce with Expert Training.</h1>
        <p class="text-gray-600 mt-4 mb-[5rem]">Enroll in structured courses, track progress, and earn certifications—all in one place.</p>
        <a href="{{ route('register') }}"
            class="bg-cyan-400 text-white pl-[90px] mb-[8rem] py-3 rounded shadow-md shadow-[0px_4px_10px_rgba(0,0,0,0.2)] mt-8 flex items-center mx-auto w-[21rem] hover:bg-blue-500 transition duration-200">
            Start Learning Now
            <i class="fas fa-arrow-right ml-2"></i>
        </a>

        <!-- Rest of your HTML content... -->
        
        <!-- Why choose Us section -->
        <div class="flex flex-col items-center justify-center mt-20">
            <h2 class="text-3xl font-light">Why choose Us?</h2>

            <div class="w-[60%] text-gray-700">
                <div class="flex items-center justify-between my-[10rem]">
                    <div class="text-center md:text-left">
                        <h3 class="text-3xl font-bold">Job-Specific Learning Paths:</h3>
                        <p class="text-3xl w-[450px]">Courses auto-mapped to roles</p>
                    </div>
                    <img alt="Illustration" class="w-[350px] h-[350px] ml-4" src="{{ asset('images/homepage/u2863.svg') }}" />
                </div>

                <!-- Other sections... -->
            </div>
        </div>

        <!-- Testimonials section -->
        <div class="container mx-auto py-12">
            <h1 class="text-4xl font-bold text-center mb-8">Testimonials</h1>
            <div class="relative flex items-center justify-center">
                <div class="flex space-x-8 overflow-x-auto overflow-y-hidden w-[80%] mx-auto" id="testimonialSlider">
                    <!-- Testimonial cards... -->
                </div>
            </div>
            <div class="flex justify-center mt-4" id="indicatorContainer">
                <span class="h-2 w-2 bg-gray-400 rounded-full mx-1"></span>
                <span class="h-2 w-2 bg-gray-400 rounded-full mx-1"></span>
                <span class="h-2 w-2 bg-gray-400 rounded-full mx-1"></span>
            </div>
        </div>
    </main>

    <footer class="bg-white py-4">
        <div class="container mx-auto flex flex-col">
            <div class="flex items-center">
                <img alt="Npontu Learning Hub logo" class="mb-2" src="{{ asset('images/sign_in_sign_up/logo_u45.svg') }}" />
                <p class="text-center mb-4 ml-12 pt-4">Brief overview of courses</p>
            </div>
            <div class="flex justify-between mt-4">
                <div class="flex space-x-4 mb-4">
                    <p class="text-center text-gray-600">© {{ date('Y') }} Npontu</p>
                    <a class="text-gray-600" href="#">About Us</a>
                    <a class="text-gray-600" href="#">Terms of Service</a>
                    <a class="text-gray-600" href="#">Privacy Policy</a>
                    <a class="text-gray-600" href="#">Contact Us</a>
                </div>
                <div class="flex space-x-4">
                    <a class="text-gray-600 text-3xl" href="#"><i class="fab fa-whatsapp"></i></a>
                    <a class="text-gray-600 text-3xl" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="text-gray-600 text-3xl" href="#"><i class="fab fa-facebook"></i></a>
                    <a class="text-gray-600 text-3xl" href="#"><i class="fab fa-github"></i></a>
                    <a class="text-gray-600 text-3xl" href="#"><i class="fab fa-linkedin"></i></a>
                    <a class="text-gray-600 text-3xl" href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const slider = document.getElementById('testimonialSlider');
        const indicators = document.querySelectorAll('#indicatorContainer span');
        const testimonialWidth = 320;
        const gap = 32;
        let currentIndex = 0;

        function updateSlider() {
            const offset = -currentIndex * (testimonialWidth + gap);
            slider.style.transform = `translateX(${offset}px)`;

            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('bg-gray-600', index === currentIndex);
                indicator.classList.toggle('bg-gray-400', index !== currentIndex);
            });
        }

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentIndex = index;
                updateSlider();
            });
        });

        updateSlider();
    </script>
</body>
</html> 