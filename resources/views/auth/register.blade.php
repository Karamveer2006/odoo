<x-structure />
<x-header />
    <div class="auth-wrapper register-wrapper">
        <div class="container-fluid">
            <div class="auth-container">
                <div class="row g-0 h-100">
                    {{-- Form Section --}}
                    <div class="col-lg-6 order-1">
                        <div class="form-section">
                            <div class="brand-header">
                                <h1><i class="fas fa-user-lock" style="color: rgb(50,184,198);"></i> Create your account</h1>
                            </div>

                            {{-- Error Messages --}}
                            @if($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <i class="fas fa-exclamation-circle"></i>
                                    Please fix the errors below
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register.submit') }}">
                                @csrf
                                
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           class="form-control @error('username') is-invalid @enderror" 
                                           id="username" 
                                           name="username" 
                                           placeholder="Username"
                                           value="{{ old('username') }}" 
                                           required>
                                    <label for="username">Username</label>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           placeholder="name@example.com"
                                           value="{{ old('email') }}" 
                                           required>
                                    <label for="email">Email address</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="tel" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           placeholder="Phone number"
                                           value="{{ old('phone') }}" 
                                           required>
                                    <label for="phone">Phone number</label>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Password" 
                                           required>
                                    <label for="password">Password</label>
                                    <div id="passwordStrength" class="password-strength"></div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" 
                                           class="form-control @error('password_confirmation') is-invalid @enderror" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Confirm Password" 
                                           required>
                                    <label for="password_confirmation">Confirm Password</label>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    <i class="fas fa-user-plus"></i> Create Account
                                </button>
                            </form>

                            <div class="bottom-links">
                                <p class="text-muted mb-2">Already have an account?</p>
                                <a href="{{ route('login') }}">Sign in here</a>
                            </div>
                        </div>
                    </div>

                    {{-- Illustration Section --}}
                    <div class="col-lg-6 order-2">
                        <div class="illustration-section">
                            {{-- SVG content here --}}
                             <svg class="civic-svg" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                                {{-- Background elements --}}
                                <rect x="0" y="0" width="400" height="300" fill="rgba(255,255,255,0.1)" rx="20"/>
                                
                                {{-- Community network illustration --}}
                                <circle cx="200" cy="100" r="40" fill="rgba(255,255,255,0.2)"/>
                                <circle cx="200" cy="100" r="25" fill="rgba(255,255,255,0.3)"/>
                                
                                {{-- Central user icon --}}
                                <circle cx="200" cy="90" r="12" fill="rgba(255,255,255,0.9)"/>
                                <rect x="190" y="105" width="20" height="25" fill="rgba(255,255,255,0.9)" rx="8"/>
                                
                                {{-- Surrounding community members --}}
                                <circle cx="120" cy="80" r="8" fill="rgba(255,255,255,0.7)"/>
                                <rect x="115" y="90" width="10" height="15" fill="rgba(255,255,255,0.7)" rx="4"/>
                                
                                <circle cx="280" cy="120" r="8" fill="rgba(255,255,255,0.7)"/>
                                <rect x="275" y="130" width="10" height="15" fill="rgba(255,255,255,0.7)" rx="4"/>
                                
                                <circle cx="150" cy="160" r="8" fill="rgba(255,255,255,0.7)"/>
                                <rect x="145" y="170" width="10" height="15" fill="rgba(255,255,255,0.7)" rx="4"/>
                                
                                <circle cx="250" cy="180" r="8" fill="rgba(255,255,255,0.7)"/>
                                <rect x="245" y="190" width="10" height="15" fill="rgba(255,255,255,0.7)" rx="4"/>
                                
                                <circle cx="320" cy="160" r="8" fill="rgba(255,255,255,0.7)"/>
                                <rect x="315" y="170" width="10" height="15" fill="rgba(255,255,255,0.7)" rx="4"/>
                                
                                {{-- Connection lines --}}
                                <line x1="200" y1="100" x2="125" y2="85" stroke="rgba(255,255,255,0.5)" stroke-width="2" stroke-dasharray="4,4"/>
                                <line x1="200" y1="100" x2="280" y2="125" stroke="rgba(255,255,255,0.5)" stroke-width="2" stroke-dasharray="4,4"/>
                                <line x1="200" y1="100" x2="155" y2="165" stroke="rgba(255,255,255,0.5)" stroke-width="2" stroke-dasharray="4,4"/>
                                <line x1="200" y1="100" x2="255" y2="185" stroke="rgba(255,255,255,0.5)" stroke-width="2" stroke-dasharray="4,4"/>
                                <line x1="200" y1="100" x2="320" y2="165" stroke="rgba(255,255,255,0.5)" stroke-width="2" stroke-dasharray="4,4"/>
                                
                                {{-- Issue reporting icons floating around --}}
                                <circle cx="80" cy="50" r="15" fill="rgba(255,255,255,0.2)"/>
                                <text x="80" y="55" text-anchor="middle" fill="white" font-size="14">🚧</text>
                                
                                <circle cx="320" cy="40" r="15" fill="rgba(255,255,255,0.2)"/>
                                <text x="320" y="45" text-anchor="middle" fill="white" font-size="14">💡</text>
                                
                                <circle cx="60" cy="150" r="15" fill="rgba(255,255,255,0.2)"/>
                                <text x="60" y="155" text-anchor="middle" fill="white" font-size="14">🗑️</text>
                                
                                <circle cx="340" cy="200" r="15" fill="rgba(255,255,255,0.2)"/>
                                <text x="340" y="205" text-anchor="middle" fill="white" font-size="14">🚰</text>
                                
                                {{-- Buildings in background --}}
                                <rect x="50" y="220" width="30" height="60" fill="rgba(255,255,255,0.15)" rx="3"/>
                                <rect x="90" y="200" width="25" height="80" fill="rgba(255,255,255,0.1)" rx="3"/>
                                <rect x="280" y="210" width="35" height="70" fill="rgba(255,255,255,0.15)" rx="3"/>
                                <rect x="325" y="230" width="28" height="50" fill="rgba(255,255,255,0.1)" rx="3"/>
                                
                                {{-- Small windows --}}
                                <rect x="57" y="235" width="4" height="4" fill="rgba(255,255,255,0.3)"/>
                                <rect x="67" y="235" width="4" height="4" fill="rgba(255,255,255,0.3)"/>
                                <rect x="57" y="250" width="4" height="4" fill="rgba(255,255,255,0.3)"/>
                                <rect x="67" y="250" width="4" height="4" fill="rgba(255,255,255,0.3)"/>
                                
                                {{-- Decorative dots --}}
                                <circle cx="40" cy="100" r="2" fill="rgba(255,255,255,0.4)"/>
                                <circle cx="360" cy="120" r="3" fill="rgba(255,255,255,0.3)"/>
                                <circle cx="30" cy="180" r="2" fill="rgba(255,255,255,0.4)"/>
                                <circle cx="370" cy="80" r="2" fill="rgba(255,255,255,0.3)"/>
                            </svg>

                            <div class="illustration-content">
                                <h2>Join the Community!</h2>
                                <p>Become part of an active community working together to improve local neighborhoods and make cities better places to live.</p>
                                
                                <ul class="feature-list d-none d-md-block">
                                    <li><i class="fas fa-user-plus"></i> Easy registration process</li>
                                    <li><i class="fas fa-shield-alt"></i> Secure & private data</li>
                                    <li><i class="fas fa-users"></i> Connect with neighbors</li>
                                    <li><i class="fas fa-heart"></i> Make a real difference</li>
                                    <li><i class="fas fa-trophy"></i> Track your impact</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthIndicator = document.getElementById('passwordStrength');
            
            if (password.length === 0) {
                strengthIndicator.textContent = '';
                strengthIndicator.className = 'password-strength';
                return;
            }
            
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;
            
            if (strength < 3) {
                strengthIndicator.textContent = 'Weak password';
                strengthIndicator.className = 'password-strength weak';
            } else if (strength < 4) {
                strengthIndicator.textContent = 'Medium strength';
                strengthIndicator.className = 'password-strength medium';
            } else {
                strengthIndicator.textContent = 'Strong password';
                strengthIndicator.className = 'password-strength strong';
            }
        });

        // Real-time password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;
            
            if (confirmation && password !== confirmation) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    </script>
<x-footer />