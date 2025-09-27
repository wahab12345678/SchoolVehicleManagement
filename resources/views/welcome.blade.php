<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>School Vehicle Management — Coming Soon</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <meta name="description" content="School Vehicle Management — manage students, guardians, vehicles, routes and trips with ease. Coming soon." />
        <style>
            :root{
                --bg1:#0f172a; /* slate-900 */
                --bg2:#0ea5a4; /* teal */
                --card:#ffffff;
                --muted:#6b7280;
                --accent:#f97316; /* orange */
            }
            /* make sizing predictable and avoid accidental overflow */
            *,*::before,*::after{box-sizing:border-box}
            html,body{min-height:100vh;height:100%;margin:0}
            body{font-family:'Instrument Sans', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;background:linear-gradient(135deg,var(--bg1) 0%, #083344 40%, #042b2f 60%);color:#e6eef0;display:flex;align-items:center;justify-content:center;padding:24px}
            .container{width:100%;max-width:1100px;display:grid;grid-template-columns:1fr 420px;gap:32px;align-items:center}
            @media (max-width:900px){.container{grid-template-columns:1fr;padding:20px;gap:18px}}
            .left{padding:28px;background:linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));border-radius:16px;box-shadow:0 8px 30px rgba(2,6,23,0.6);backdrop-filter: blur(6px)}
            .brand{display:flex;align-items:center;gap:14px}
            .logo{width:56px;height:56px;display:grid;place-items:center;border-radius:12px;background:linear-gradient(135deg,var(--accent),#ef4444);box-shadow:0 6px 18px rgba(239,68,68,0.18)}
            .logo svg{width:32px;height:32px;fill:white}
            .logo-img{width:56px;height:56px;border-radius:12px;object-fit:cover;display:block}
            h1{font-size:34px;margin:18px 0 6px;color:#fff}
            .tag{color:var(--accent);font-weight:600}
            p.lead{color:var(--muted);margin:0 0 18px;line-height:1.5}
            ul.features{list-style:none;padding:0;margin:0 0 22px;display:flex;flex-direction:column;gap:10px}
            ul.features li{display:flex;gap:12px;align-items:flex-start}
            ul.features li .dot{width:10px;height:10px;border-radius:50%;background:linear-gradient(180deg,var(--accent),#ffb86b);margin-top:6px}
            .actions{display:flex;gap:12px;flex-wrap:wrap}
            .btn{display:inline-flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;background:transparent;border:1px solid rgba(255,255,255,0.08);color:inherit;text-decoration:none;font-weight:600}
            .btn.primary{background:linear-gradient(90deg,var(--accent),#ef4444);color:#fff;border:none;box-shadow:0 8px 24px rgba(239,68,68,0.18)}
            .right{padding:24px;background:var(--card);border-radius:12px;box-shadow:0 8px 24px rgba(2,6,23,0.5);color:#0b1220}
            .right h3{margin:0 0 8px}
            .project-meta{font-size:14px;color:var(--muted);margin-bottom:14px}
            /* notify removed - using contact form only */
            .small{font-size:13px;color:#6b7280;margin-top:12px}
            .toast{position:fixed;right:20px;bottom:20px;background:#0b1220;color:#e6eef0;padding:10px 14px;border-radius:8px;box-shadow:0 8px 24px rgba(2,6,23,0.6);display:none}
            <!DOCTYPE html>
            <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
                <head>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1" />
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <title>School Vehicle Management — Coming Soon</title>
                    <link rel="preconnect" href="https://fonts.bunny.net">
                    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
                    <meta name="description" content="School Vehicle Management — manage students, guardians, vehicles, routes and trips with ease. Coming soon." />
                    <style>
                        :root{
                            --bg1:#0f172a; /* slate-900 */
                            --bg2:#0ea5a4; /* teal */
                            --card:#ffffff;
                            --muted:#6b7280;
                            --accent:#f97316; /* orange */
                        }
                        *,*::before,*::after{box-sizing:border-box}
                        html,body{min-height:100vh;height:100%;margin:0}
                        body{font-family:'Instrument Sans', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;background:linear-gradient(135deg,var(--bg1) 0%, #083344 40%, #042b2f 60%);color:#e6eef0;display:flex;align-items:center;justify-content:center;padding:24px}
                        .container{width:100%;max-width:1100px;display:grid;grid-template-columns:1fr 420px;gap:32px;align-items:center}
                        @media (max-width:900px){.container{grid-template-columns:1fr;padding:20px;gap:18px}}
                        .left{padding:28px;background:linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));border-radius:16px;box-shadow:0 8px 30px rgba(2,6,23,0.6);backdrop-filter: blur(6px)}
                        .brand{display:flex;align-items:center;gap:14px}
                        .logo{width:56px;height:56px;display:grid;place-items:center;border-radius:12px;background:linear-gradient(135deg,var(--accent),#ef4444);box-shadow:0 6px 18px rgba(239,68,68,0.18)}
                        .logo-img{width:56px;height:56px;border-radius:12px;object-fit:cover;display:block}
                        h1{font-size:34px;margin:18px 0 6px;color:#fff}
                        .tag{color:var(--accent);font-weight:600}
                        p.lead{color:var(--muted);margin:0 0 18px;line-height:1.5}
                        ul.features{list-style:none;padding:0;margin:0 0 22px;display:flex;flex-direction:column;gap:10px}
                        ul.features li{display:flex;gap:12px;align-items:flex-start}
                        ul.features li .dot{width:10px;height:10px;border-radius:50%;background:linear-gradient(180deg,var(--accent),#ffb86b);margin-top:6px}
                        .actions{display:flex;gap:12px;flex-wrap:wrap}
                        .btn{display:inline-flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;background:transparent;border:1px solid rgba(255,255,255,0.08);color:inherit;text-decoration:none;font-weight:600}
                        .btn.primary{background:linear-gradient(90deg,var(--accent),#ef4444);color:#fff;border:none;box-shadow:0 8px 24px rgba(239,68,68,0.18)}
                        .right{padding:24px;background:var(--card);border-radius:12px;box-shadow:0 8px 24px rgba(2,6,23,0.5);color:#0b1220}
                        .right h3{margin:0 0 8px}
                        .project-meta{font-size:14px;color:var(--muted);margin-bottom:14px}
                        .small{font-size:13px;color:#6b7280;margin-top:12px}
                        .toast{position:fixed;right:20px;bottom:20px;background:#0b1220;color:#e6eef0;padding:10px 14px;border-radius:8px;box-shadow:0 8px 24px rgba(2,6,23,0.6);display:none}
                        .powered{margin-top:20px;font-size:13px;color:var(--muted)}
                    </style>
                </head>
                <body>
                    <div class="container" role="main">
                        <section class="left" aria-labelledby="coming-title">
                            <div class="brand">
                                <div class="logo" aria-hidden="true">
                                    <img src="{{ asset('images/final_logo.png') }}" alt="School Vehicle Management logo" class="logo-img" />
                                </div>
                                <div>
                                    <div style="font-weight:700;font-size:16px;color:#fff">School Vehicle Management</div>
                                    <div style="font-size:13px;color:var(--muted)">Manage routes, trips & safety</div>
                                </div>
                            </div>

                            <h1 id="coming-title">We’re launching soon</h1>
                            <div class="tag">A smarter way to manage school transport</div>

                            <p class="lead">We’re building an intuitive platform to manage students, guardians, vehicles, routes and daily trips — with safety, scheduling and reporting at the center. Join us as we make school transportation reliable and easy.</p>

                            <ul class="features" aria-hidden="false">
                                <li><span class="dot" aria-hidden="true"></span><div><strong>Guardian & student profiles</strong><div class="small">Link guardians to students for quick contact and permissions.</div></div></li>
                                <li><span class="dot" aria-hidden="true"></span><div><strong>Vehicle & driver management</strong><div class="small">Maintain vehicles, assignments and maintenance logs.</div></div></li>
                                <li><span class="dot" aria-hidden="true"></span><div><strong>Trips & routes</strong><div class="small">Plan routes, schedule trips and track statuses.</div></div></li>
                                <li><span class="dot" aria-hidden="true"></span><div><strong>Reports & safety</strong><div class="small">Attendance, trip history and safety checks in one place.</div></div></li>
                            </ul>

                            <div class="actions">
                                @if (Route::has('login'))
                                    @auth
                                        <a href="{{ url('/admin/dashboard') }}" class="btn primary" aria-label="Go to dashboard">Go to dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn" aria-label="Log in">Log in</a>
                                    @endauth
                                @endif
                                <a href="mailto:info@example.com?subject=School%20Vehicle%20Management%20Inquiry" class="btn" aria-label="Contact us">Contact us</a>
                            </div>

                            <div class="powered">Built with care • <span style="color:var(--accent);font-weight:600">Beta coming soon</span></div>
                        </section>

                        <aside class="right" aria-labelledby="contact-title">
                            <h3 id="contact-title">Send us a message</h3>
                            <div class="project-meta">Have questions or feedback? Send us a message and we'll get back to you.</div>

                            <div class="small">What we’re building:</div>
                            <ul style="margin:10px 0 0 18px;color:#0b1220">
                                <li style="margin-bottom:6px">Real-time trip status & attendance</li>
                                <li style="margin-bottom:6px">Driver and vehicle assignments</li>
                                <li style="margin-bottom:6px">Reports, exports and admin controls</li>
                            </ul>

                            <div class="small" style="margin-top:18px;color:#475569">Questions? Email <a href="mailto:info@example.com">info@example.com</a></div>

                            <!-- Contact form (AJAX) - visible by default -->
                            <form id="contact-form" style="margin-top:16px;display:flex;flex-direction:column;gap:8px" aria-label="Contact form">
                                <input id="contact-name" name="name" type="text" placeholder="Your name (optional)" style="padding:10px;border-radius:8px;border:1px solid #e6eef0;font-size:14px" />
                                <input id="contact-email" name="email" type="email" placeholder="Your email address" required style="padding:10px;border-radius:8px;border:1px solid #e6eef0;font-size:14px" />
                                <textarea id="contact-message" name="message" placeholder="How can we help?" rows="4" style="padding:10px;border-radius:8px;border:1px solid #e6eef0;font-size:14px"></textarea>
                                <div style="display:flex;gap:8px;align-items:center">
                                    <button id="contact-submit" type="submit" class="btn primary">Send message</button>
                                </div>
                            </form>
                        </aside>
                    </div>

                    <div id="toast" class="toast" role="status" aria-live="polite"></div>

                    <script>
                        const toast = document.getElementById('toast');
                        function showToast(msg){
                            toast.textContent = msg; toast.style.display = 'block';
                            setTimeout(()=> toast.style.display = 'none', 3500);
                        }

                        (function(){
                            const form = document.getElementById('contact-form');
                            const submit = document.getElementById('contact-submit');

                            function csrf(){
                                const m = document.querySelector('meta[name="csrf-token"]');
                                return m ? m.getAttribute('content') : '';
                            }

                            if(form){
                                form.addEventListener('submit', function(e){
                                    e.preventDefault();
                                    const name = (document.getElementById('contact-name').value || '').trim();
                                    const email = (document.getElementById('contact-email').value || '').trim();
                                    const message = (document.getElementById('contact-message').value || '').trim();
                                    if(!email || !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)){
                                        showToast('Please provide a valid email');
                                        return;
                                    }
                                    submit.disabled = true; submit.textContent = 'Sending...';

                                    fetch('{{ route("contact.store") }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': csrf()
                                        },
                                        body: JSON.stringify({ name, email, message })
                                    }).then(r => r.json()).then(data => {
                                        submit.disabled = false; submit.textContent = 'Send message';
                                        if(data && data.ok){
                                            showToast('Message sent — thank you!');
                                            document.getElementById('contact-name').value = '';
                                            document.getElementById('contact-email').value = '';
                                            document.getElementById('contact-message').value = '';
                                        } else {
                                            showToast((data && data.message) ? data.message : 'Could not send message');
                                        }
                                    }).catch(err => {
                                        submit.disabled = false; submit.textContent = 'Send message';
                                        console.error(err);
                                        showToast('Network error — please try later');
                                    });
                                });
                            }
                        })();
                    </script>
                </body>
            </html>
