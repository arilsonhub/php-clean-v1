<?php
declare(strict_types=1);

namespace App\Presenters\Http;

use App\Factory\GenericFactory;
use App\ViewModels\ViewModel;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use JsonSerializable;

class JsonPresenter
{
    private $genericFactory;

    public function __construct(GenericFactory $genericFactory)
    {
        $this->genericFactory = $genericFactory;
    }

    public function sendViewModel(Arrayable $viewModel, $statusCode = 200): JsonResponse
    {
        return response()->json($viewModel->toArray(), $statusCode);
    }

    public function sendViewModelFromArray(Array $data, $statusCode = 200): JsonResponse
    {
        return $this->getViewModelFromData($data, $statusCode);
    }

    public function sendViewModelFromJsonObject(JsonSerializable $data, $statusCode = 200): JsonResponse
    {
        return $this->getViewModelFromData($data->jsonSerialize(), $statusCode);
    }

    private function getViewModelFromData(Array $data, $statusCode)
    {
        $viewModel = $this->genericFactory->getInstance(ViewModel::class,['data' => $data]);
        return response()->json($viewModel->toArray(), $statusCode);
    }
}
