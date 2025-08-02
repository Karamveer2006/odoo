<x-structure />
<x-header />

     <div class="auth-wrapper login-wrapper">
        <div class="container-fluid">
            <div class="auth-container">
                <div class="row g-0 h-100">
                    {{-- Illustration Section --}}
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="illustration-section">
                            {{-- SVG content here --}}
                            <svg class="civic-svg" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                                {{-- Background elements --}}
                                <rect x="0" y="0" width="400" height="300" fill="rgba(255,255,255,0.1)" rx="20"/>
                                
                                {{-- City skyline --}}
                                <rect x="50" y="200" width="40" height="80" fill="rgba(255,255,255,0.2)" rx="4"/>
                                <rect x="100" y="180" width="35" height="100" fill="rgba(255,255,255,0.15)" rx="4"/>
                                <rect x="145" y="190" width="50" height="90" fill="rgba(255,255,255,0.2)" rx="4"/>
                                <rect x="205" y="170" width="40" height="110" fill="rgba(255,255,255,0.15)" rx="4"/>
                                <rect x="255" y="185" width="45" height="95" fill="rgba(255,255,255,0.2)" rx="4"/>
                                <rect x="310" y="200" width="35" height="80" fill="rgba(255,255,255,0.15)" rx="4"/>
                                
                                {{-- Windows --}}
                                <rect x="60" y="210" width="6" height="6" fill="rgba(255,255,255,0.4)"/>
                                <rect x="70" y="210" width="6" height="6" fill="rgba(255,255,255,0.4)"/>
                                <rect x="60" y="225" width="6" height="6" fill="rgba(255,255,255,0.4)"/>
                                <rect x="70" y="225" width="6" height="6" fill="rgba(255,255,255,0.4)"/>
                                
                                <rect x="110" y="195" width="6" height="6" fill="rgba(255,255,255,0.4)"/>
                                <rect x="120" y="195" width="6" height="6" fill="rgba(255,255,255,0.4)"/>
                                <rect x="110" y="210" width="6" height="6" fill="rgba(255,255,255,0.4)"/>
                                <rect x="120" y="210" width="6" height="6" fill="rgba(255,255,255,0.4)"/>
                                
                                {{-- Main illustration - Mobile phone with location --}}
                                <rect x="170" y="80" width="60" height="100" fill="rgba(255,255,255,0.9)" rx="12"/>
                                <rect x="175" y="90" width="50" height="70" fill="#1f2937" rx="4"/>
                                
                                {{-- Phone screen content --}}
                                <circle cx="200" cy="110" r="8" fill="#ef4444"/>
                                <polygon points="200,115 197,120 203,120" fill="#ef4444"/>
                                <circle cx="185" cy="125" r="6" fill="#10b981"/>
                                <polygon points="185,129 183,132 187,132" fill="#10b981"/>
                                <circle cx="215" cy="140" r="6" fill="#f59e0b"/>
                                <polygon points="215,144 213,147 217,147" fill="#f59e0b"/>
                                
                                {{-- Connection lines from phone --}}
                                <line x1="200" y1="60" x2="120" y2="30" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-dasharray="4,4"/>
                                <line x1="200" y1="60" x2="280" y2="30" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-dasharray="4,4"/>
                                <line x1="200" y1="60" x2="320" y2="50" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-dasharray="4,4"/>
                                
                                {{-- Floating icons --}}
                                <circle cx="120" cy="25" r="15" fill="rgba(255,255,255,0.2)"/>
                                <text x="120" y="30" text-anchor="middle" fill="white" font-size="14">🏠</text>
                                
                                <circle cx="280" cy="25" r="15" fill="rgba(255,255,255,0.2)"/>
                                <text x="280" y="30" text-anchor="middle" fill="white" font-size="14">💡</text>
                                
                                <circle cx="320" cy="45" r="15" fill="rgba(255,255,255,0.2)"/>
                                <text x="320" y="50" text-anchor="middle" fill="white" font-size="14">🚧</text>
                                
                                {{-- Decorative elements --}}
                                <circle cx="80" cy="60" r="3" fill="rgba(255,255,255,0.3)"/>
                                <circle cx="320" cy="80" r="4" fill="rgba(255,255,255,0.25)"/>
                                <circle cx="350" cy="120" r="2" fill="rgba(255,255,255,0.4)"/>
                                <circle cx="40" cy="100" r="2" fill="rgba(255,255,255,0.35)"/>
                            </svg>

                            <div class="illustration-content">
                                <h2>Welcome Back!</h2>
                                <p>Sign in to continue reporting and tracking local community issues in your neighborhood.</p>
                                
                                <ul class="feature-list d-none d-md-block">
                                    <li><i class="fas fa-map-marker-alt"></i> Track local issues in real-time</li>
                                    <li><i class="fas fa-users"></i> Connect with your community</li>
                                    <li><i class="fas fa-bell"></i> Get instant status updates</li>
                                    <li><i class="fas fa-shield-alt"></i> Secure and anonymous reporting</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Form Section --}}
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="form-section">
                            <div class="brand-header">
                                <h1><i class="fas fa-key" style="color: rgb(50,184,198);"></i> Sign in to your account</h1>
                            </div>

                            {{-- Error Messages --}}
                            @if($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $errors->first() }}
                                </div>
                            @endif
                            @if (session('success') )
                                <div class="alert alert-success mb-3">
                                    <i class="fas fa-check-circle"></i>
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
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
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Password" 
                                           required>
                                    <label for="password">Password</label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="{{ route('password.reset') }}" class="text-decoration-none mt-2 mt-sm-0">
                                        Forgot password?
                                    </a>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    <i class="fas fa-sign-in-alt"></i> Sign In
                                </button>
                            </form>

                            <div class="bottom-links">
                                <p class="text-muted mb-2">Don't have an account?</p>
                                <a href="{{ route('register') }}">Create your account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<x-footer />