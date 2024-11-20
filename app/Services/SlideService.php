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

    public function paginate($request, $languageId){

        $perPage = $request->integer('perpage', 10);
        $condition['keyword'] = $request->input('keyword');
        $slides = $this->slideRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'slide/index'],
        );

        return $slides;
    }


    public function create($request, $languageId){
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
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function update($id, $request, $languageId){
        DB::beginTransaction();
        try{
            $slide = $this->slideRepository->findById($id);
            $slideItem = $slide->item;
            unset($slideItem[$languageId]);
            $payload = $request->only(['_token', 'name', 'keyword', 'setting', 'short_code']);
            $payload['item'] = $this->handleSlideItem($request, $languageId) + $slideItem;
            $slide = $this->slideRepository->update($id, $payload);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function destroy($id){
        DB::beginTransaction();
        try{
            $slide = $this->slideRepository->delete($id);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function updateStatus($slide = [])
    {
        DB::beginTransaction();
        try {
            $payload = [$slide['field'] =>(($slide['value'] == 1) ? 2 : 1)];
            $slide = $this->slideRepository->update($slide['modelId'], $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatusAll($slide){
        DB::beginTransaction();
        try{
            $payload[$slide['field']] = $slide['value'];
            $flag = $this->slideRepository->updateByWhereIn('id', $slide['id'], $payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            echo $e->getMessage();die();
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
        foreach ($slide as $key => $val) {
            foreach($fields as $field) {
                $temp[$field][] = $val[$field];
            }
        }
        return $temp;
    }


    // ------ OUTPUT SLIDE FE
    public function getSlide($array = [], $language = 1){
        $slides = $this->slideRepository->findByCondition(...$this->getSlideAgrument($array));
        $temp = [];
        foreach($slides as $key => $val){
            $temp[$val->keyword]['item'] = $val->item[$language];
            $temp[$val->keyword]['setting'] = $val->setting;
        }
        return $temp;
    }

    private function getSlideAgrument($array){
        return [
            'condition' => [
                config('apps.general.defaultPublish'),
            ],
            'flag' => true,
            'relation' => [],
            'orderBy' => ['id', 'desc'],
            'param' => [
                'whereIn' => $array,
                'whereInField' => 'keyword'
            ]
        ];
    }

}
