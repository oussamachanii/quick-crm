<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Crm\Managers\Auth\Employee\EmployeeAuthManager;
use Crm\Services\Auth\EmployeeAuthService;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;
use Crm\Validators\Exceptions\ValidationException;

class StoreLoginController extends Controller
{
    public function __construct(
        private readonly RateLimiter $rateLimiter,
        private readonly EmployeeAuthService $employeeAuthService
    ) {
        parent::__construct();
    }

    public function __invoke(LoginRequest $request)
    {
        try {
            $this->ensureIsNotRateLimited($this->throttleKey($request));

            $email = $request->get('email');
            $password = $request->get('password');
            $rememberMe = (bool)$request->get('rememberMe');
            $this->employeeAuthService->authenticate($email, $password, $rememberMe);

            return redirect()
                ->route(EmployeeAuthManager::HOME_PAGE);
        } catch (ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->getErrors());
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('Could not login error');
        }
    }

    /**
     * @param string $key
     *
     * @return void
     * @throws ValidationException
     */
    private function ensureIsNotRateLimited(string $key): void
    {
        if (!$this->rateLimiter->tooManyAttempts($key, 5)) {
            return;
        }

        throw ValidationException::withMessages(
            [
                'email' => 'Attempts exceeded',
            ]
        );
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @param Request $request
     *
     * @return string
     */
    private function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }
}
