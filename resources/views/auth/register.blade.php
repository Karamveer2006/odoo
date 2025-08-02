{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - CivicTrack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- FontAwesome 5 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
        }
        
        .register-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .register-container {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            margin: 2rem auto;
        }
        
        .form-section {
            padding: 3rem 2.5rem;
        }
        
        .illustration-section {
            background: #f8fafc;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-left: 1px solid #e5e7eb;
        }
        
        .brand-header {
            margin-bottom: 2.5rem;
        }
        
        .brand-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        
        .brand-header p {
            color: #6b7280;
            font-size: 0.95rem;
            margin: 0;
        }
        
        .illustration-content h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }
        
        .illustration-content p {
            color: #6b7280;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }
        
        .feature-list li {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }
        
        .feature-list li i {
            color: #10b981;
            margin-right: 0.75rem;
            width: 16px;
        }
        
        .form-floating > label {
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        .form-control {
            border: 1.5px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1rem 1rem;
            font-size: 1rem;
            height: auto;
            background: #ffffff;
            transition: border-color 0.15s ease-in-out;
        }
        
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: none;
            background: #ffffff;
        }
        
        .form-control.is-invalid {
            border-color: #ef4444;
        }
        
        .invalid-feedback {
            font-size: 0.85rem;
            color: #ef4444;
        }
        
        .btn-primary {
            background: #3b82f6;
            border: 1px solid #3b82f6;
            border-radius: 0.75rem;
            padding: 0.875rem 1.5rem;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.15s ease-in-out;
        }
        
        .btn-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
            transform: translateY(-1px);
        }
        
        .form-check-input {
            border: 1.5px solid #d1d5db;
            border-radius: 0.375rem;
        }
        
        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        
        .form-check-label {
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        .bottom-links {
            text-align: center;
            margin-top: 2rem;
        }
        
        .bottom-links a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .bottom-links a:hover {
            color: #2563eb;
            text-decoration: underline;
        }
        
        .alert {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #dc2626;
            border-radius: 0.75rem;
            font-size: 0.9rem;
        }
        
        .password-strength {
            font-size: 0.8rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }
        
        .password-strength.weak { color: #ef4444; }
        .password-strength.medium { color: #f59e0b; }
        .password-strength.strong { color: #10b981; }
        
        .civic-svg {
            max-width: 280px;
            margin-bottom: 2rem;
        }
        
        @media (max-width: 768px) {
            .register-container {
                margin: 1rem;
            }
            
            .illustration-section {
                display: none;
            }
            
            .form-section {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="register-wrapper">
        <div class="container-fluid">
            <div class="register-container">
                <div class="row g-0 h-100">
                    {{-- Form Section --}}
                    <div class="col-lg-6">
                        <div class="form-section">
                            <div class="brand-header">
                                <h1><i class="fas fa-location-arrow text-primary"></i> CivicTrack</h1>
                                <p>Create your account to get started</p>
                            </div>

                            {{-- Error Messages --}}
                            @if($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <i class="fas fa-exclamation-circle"></i>
                                    Please fix the errors below
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}">
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

                                <div class="form-check mb-4">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" 
                                           type="checkbox" 
                                           name="terms" 
                                           id="terms" 
                                           required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>
                                    </label>
                                    @error('terms')
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
                    <div class="col-lg-6">
                        <div class="illustration-section">
                            {{-- SVG Illustration --}}
                            <svg class="civic-svg" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                                {{-- Background buildings --}}
                                <rect x="50" y="120" width="60" height="100" fill="#e5e7eb" rx="4"/>
                                <rect x="120" y="100" width="50" height="120" fill="#d1d5db" rx="4"/>
                                <rect x="180" y="130" width="70" height="90" fill="#e5e7eb" rx="4"/>
                                <rect x="260" y="110" width="55" height="110" fill="#d1d5db" rx="4"/>
                                <rect x="325" y="140" width="45" height="80" fill="#e5e7eb" rx="4"/>
                                
                                {{-- Windows --}}
                                <rect x="60" y="135" width="8" height="8" fill="#f3f4f6"/>
                                <rect x="75" y="135" width="8" height="8" fill="#f3f4f6"/>
                                <rect x="90" y="135" width="8" height="8" fill="#f3f4f6"/>
                                <rect x="60" y="150" width="8" height="8" fill="#f3f4f6"/>
                                <rect x="75" y="150" width="8" height="8" fill="#f3f4f6"/>
                                <rect x="90" y="150" width="8" height="8" fill="#f3f4f6"/>
                                
                                <rect x="130" y="115" width="8" height="8" fill="#f3f4f6"/>
                                <rect x="145" y="115" width="8" height="8" fill="#f3f4f6"/>
                                <rect x="130" y="130" width="8" height="8" fill="#f3f4f6"/>
                                <rect x="145" y="130" width="8" height="8" fill="#f3f4f6"/>
                                
                                {{-- Street --}}
                                <rect x="0" y="220" width="400" height="80" fill="#9ca3af"/>
                                <line x1="0" y1="260" x2="400" y2="260" stroke="#ffffff" stroke-width="2" stroke-dasharray="10,5"/>
                                
                                {{-- Street lights --}}
                                <line x1="80" y1="220" x2="80" y2="190" stroke="#6b7280" stroke-width="3"/>
                                <circle cx="80" cy="185" r="8" fill="#fbbf24"/>
                                <line x1="200" y1="220" x2="200" y2="190" stroke="#6b7280" stroke-width="3"/>
                                <circle cx="200" cy="185" r="8" fill="#fbbf24"/>
                                <line x1="320" y1="220" x2="320" y2="190" stroke="#6b7280" stroke-width="3"/>
                                <circle cx="320" cy="185" r="8" fill="#fbbf24"/>
                                
                                {{-- Main illustration - Person with phone --}}
                                <circle cx="200" cy="80" r="25" fill="#fef2f2"/>
                                <circle cx="200" cy="75" r="12" fill="#f3e8ff"/>
                                <rect x="190" y="105" width="20" height="35" fill="#3b82f6" rx="8"/>
                                <rect x="185" y="115" width="30" height="40" fill="#1f2937" rx="6"/>
                                <rect x="165" y="125" width="15" height="20" fill="#fbbf24" rx="3"/>
                                <rect x="220" y="125" width="15" height="20" fill="#fbbf24" rx="3"/>
                                
                                {{-- Phone --}}
                                <rect x="175" y="90" width="12" height="20" fill="#1f2937" rx="2"/>
                                <rect x="177" y="92" width="8" height="12" fill="#3b82f6" rx="1"/>
                                
                                {{-- Location pins --}}
                                <circle cx="150" cy="160" r="8" fill="#ef4444"/>
                                <polygon points="150,165 147,170 153,170" fill="#ef4444"/>
                                <circle cx="250" cy="175" r="8" fill="#10b981"/>
                                <polygon points="250,180 247,185 253,185" fill="#10b981"/>
                                <circle cx="300" cy="155" r="8" fill="#f59e0b"/>
                                <polygon points="300,160 297,165 303,165" fill="#f59e0b"/>
                                
                                {{-- Connection lines --}}
                                <line x1="187" y1="100" x2="150" y2="160" stroke="#3b82f6" stroke-width="2" stroke-dasharray="3,3" opacity="0.6"/>
                                <line x1="187" y1="100" x2="250" y2="175" stroke="#3b82f6" stroke-width="2" stroke-dasharray="3,3" opacity="0.6"/>
                                <line x1="187" y1="100" x2="300" y2="155" stroke="#3b82f6" stroke-width="2" stroke-dasharray="3,3" opacity="0.6"/>
                            </svg>

                            <div class="illustration-content">
                                <h2>Join Your Community</h2>
                                <p>Help make your neighborhood better by reporting local issues and tracking their resolution in real-time.</p>
                                
                                <ul class="feature-list">
                                    <li><i class="fas fa-map-marker-alt"></i> Report issues within 5km radius</li>
                                    <li><i class="fas fa-camera"></i> Add photos and descriptions</li>
                                    <li><i class="fas fa-bell"></i> Get notified on status updates</li>
                                    <li><i class="fas fa-users"></i> Connect with local community</li>
                                    <li><i class="fas fa-chart-line"></i> Track resolution progress</li>
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
</body>
</html>
