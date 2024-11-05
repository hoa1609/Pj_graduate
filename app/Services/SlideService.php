<?php

namespace App\Services;

use App\Services\Interfaces\SlideServiceInterface;
use App\Repositories\Interfaces\SlideRepositoryInterface as SlideRepository ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;


/**
 * Class SlideService
 * @package App\Services
 */
class SlideService  extends BaseService implements SlideServiceInterface
{
    protected $slideRepository;

    public function __construct(
        SlideRepository $slideRepository
    ) {
        $this->slideRepository = $slideRepository;
    }

    private function paginateSelect(){
        return [
             'id',
             'name',
             'keyword',
             'publish',
             'item',
        ];
     }

    public function paginate($request, $perPage = [])
    {
        $condition['keyword'] = $request->input('keyword');
        $slides = $this->slideRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'slide/index'],
        );

        return $slides;
    }

    public function create($request, $languageId)
    {
        DB::beginTransaction();
        try{
            $payload = $request->only(['_token', 'name', 'keyword', 'setting', 'short_code']);
            $payload['user_id'] =  Auth::id();
            $payload['item'] = $this->handleSlideItem($request, $languageId);
            $slide = $this->slideRepository->create($payload);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                // Log::error($e->getMessage());
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function update($id, $request, $languageId)
    {
        DB::beginTransaction();
        try{
            $slide = $this->slideRepository->findById($id);
            $slideItem = $slide->item;
            unset($slideItem[$languageId]);
            $payload = $request->only(['_token', 'name', 'keyword', 'setting', 'short_code']);
            $payload['item'] = $this->handleSlideItem($request, $languageId) + $slideItem;
            // dd($payload);
            $slide = $this->slideRepository->update($id, $payload);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                // Log::error($e->getMessage());
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $slide = $this->slideRepository->delete($id);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                // Log::error($e->getMessage());
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            $payload = [$post['field'] =>(($post['value'] == 1) ? 2 : 1)];
            $slide = $this->slideRepository->update($post['modelId'], $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    private function handleSlideItem($request, $languageId)
    {
        $slide = $request->input('slide');
        $temp = [];
        foreach($slide['image'] as $key => $val) {
            $temp[$languageId][] = [
                'image' => $val,
                'name' => $slide['name'][$key],
                'description' => $slide['description'][$key],
                'canonical' => $slide['canonical'][$key],
                'alt' => $slide['alt'][$key],
                'window' => (isset($slide['window'][$key])) ? $slide['window'][$key] : '',
            ];
        }
        return $temp;
    }

    public function coverSlideArray(array $slide = []): array
    {
        $temp = [];
        $fields = ['image', 'description', 'window', 'canonical', 'name', 'alt'];
        // dd($slide);
        foreach ($slide as $key => $val) {
            foreach($fields as $field) {
                $temp[$field][] = $val[$field];
            }
        }
        return $temp;
    }

}
