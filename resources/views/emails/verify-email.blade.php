<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{env('APP_URL')}}public/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Your Email - CivicTrack</title>
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: #f8fafc;
            padding: 20px 0;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 1rem;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        
        /* Header */
        .email-header {
            background: rgb(50,184,198);
            background: linear-gradient(135deg, rgb(50,184,198) 0%, rgb(40,164,178) 100%);
            padding: 2rem;
            text-align: center;
            color: white;
        }
        
        .brand-logo h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .brand-logo i {
            margin-right: 0.5rem;
        }
        
        .brand-tagline {
            font-size: 0.95rem;
            opacity: 0.9;
        }
        
        /* Content */
        .email-content {
            padding: 2.5rem 2rem;
        }
        
        .greeting {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }
        
        .main-text {
            color: #6b7280;
            font-size: 1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .confirmation-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 2rem;
            text-align: center;
            margin: 2rem 0;
        }
        
        .confirmation-icon {
            width: 80px;
            height: 80px;
            background: rgba(50,184,198,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: rgb(50,184,198);
        }
        
        .confirm-button {
            display: inline-block;
            background: rgb(50,184,198);
            color: white;
            text-decoration: none;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.15s ease-in-out;
            border: none;
            cursor: pointer;
        }
        
        .confirm-button:hover {
            background: rgb(40,164,178);
            transform: translateY(-1px);
        }
        
        .button-note {
            font-size: 0.875rem;
            color: #9ca3af;
            margin-top: 1rem;
        }
        
        .alternative-link {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin: 2rem 0;
        }
        
        .alternative-link p {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        
        .alternative-link a {
            color: rgb(50,184,198);
            word-break: break-all;
            font-family: monospace;
            font-size: 0.8rem;
        }
        
        .security-note {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 0.5rem;
            padding: 1rem;
            margin: 2rem 0;
        }
        
        .security-note h4 {
            color: #dc2626;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .security-note h4 i {
            margin-right: 0.5rem;
        }
        
        .security-note p {
            color: #991b1b;
            font-size: 0.85rem;
            margin: 0;
        }
        
        /* Footer */
        .email-footer {
            background: #f9fafb;
            padding: 2rem;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        
        .footer-content {
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        
        .footer-links {
            margin: 1rem 0;
        }
        
        .footer-links a {
            color: rgb(50,184,198);
            text-decoration: none;
            margin: 0 1rem;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
        
        .social-links {
            margin-top: 1.5rem;
        }
        
        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: #e5e7eb;
            color: #6b7280;
            border-radius: 0.5rem;
            text-align: center;
            line-height: 40px;
            margin: 0 0.5rem;
            text-decoration: none;
            transition: all 0.15s ease-in-out;
        }
        
        .social-links a:hover {
            background: rgb(50,184,198);
            color: white;
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .email-container {
                margin: 0 10px;
                border-radius: 0.75rem;
            }
            
            .email-header {
                padding: 1.5rem 1rem;
            }
            
            .brand-logo h1 {
                font-size: 1.5rem;
            }
            
            .email-content {
                padding: 2rem 1.5rem;
            }
            
            .confirmation-box {
                padding: 1.5rem 1rem;
            }
            
            .confirm-button {
                display: block;
                text-align: center;
                margin: 0 auto;
            }
            
            .email-footer {
                padding: 1.5rem 1rem;
            }
            
            .footer-links a {
                display: block;
                margin: 0.5rem 0;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="brand-logo">
                <h1><i class="fas fa-location-arrow"></i> CivicTrack</h1>
                <p class="brand-tagline">Building Better Communities Together</p>
            </div>
        </div>
        
        <!-- Content -->
        <div class="email-content">
            <h2 class="greeting">Welcome to CivicTrack!</h2>
            <p class="main-text">
                Hi <strong>{{$user->username ?? 'there'}}</strong>,<br><br>
                Thank you for registering with CivicTrack! We're excited to have you join our community of citizens working together to make our neighborhoods better places to live.
            </p>
            
            <div class="confirmation-box">
                <div class="confirmation-icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <p style="margin-bottom: 1.5rem; color: #374151; font-weight: 500;">
                    Please confirm your email address to activate your account
                </p>
                <a href="{{$confirmationUrl}}" class="confirm-button">
                    Confirm Email Address
                </a>
                <p class="button-note">
                    This button will expire in 24 hours for security reasons.
                </p>
            </div>
            
            <div class="alternative-link">
                <p><strong>Can't click the button?</strong> Copy and paste this link into your browser:</p>
                <a href="{{$confirmationUrl}}">{{$confirmationUrl}}</a>
            </div>
            
            <div class="security-note">
                <h4><i class="fas fa-shield-alt"></i> Security Notice</h4>
                <p>If you didn't create an account with CivicTrack, please ignore this email. Your email address will not be used without your confirmation.</p>
            </div>
            
            <p class="main-text">
                Once confirmed, you'll be able to:
            </p>
            <ul style="color: #6b7280; margin-left: 1.5rem; margin-bottom: 2rem;">
                <li>Report local civic issues in your neighborhood</li>
                <li>Track the status of reported problems</li>
                <li>Connect with your local community</li>
                <li>Receive updates on issue resolutions</li>
            </ul>
            
            <p class="main-text">
                If you have any questions, feel free to reach out to our support team. We're here to help!
            </p>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-content">
                <p><strong>CivicTrack Team</strong></p>
                <p>Making communities better, one report at a time.</p>
                
                <div class="footer-links">
                    <a href="{{$websiteUrl}}">Visit Website</a>
                    <a href="{{$websiteUrl}}/contact">Contact Support</a>
                    <a href="{{$websiteUrl}}/privacy">Privacy Policy</a>
                </div>
                
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                
                <p style="margin-top: 1.5rem; font-size: 0.8rem; color: #9ca3af;">
                    © {{date('Y')}} CivicTrack. All rights reserved.<br>
                    You received this email because you registered for a CivicTrack account.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
