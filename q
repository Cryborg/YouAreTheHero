[1mdiff --git a/app/Http/Controllers/PageController.php b/app/Http/Controllers/PageController.php[m
[1mindex b05a321..8c70fce 100644[m
[1m--- a/app/Http/Controllers/PageController.php[m
[1m+++ b/app/Http/Controllers/PageController.php[m
[36m@@ -193,7 +193,7 @@[m [mclass PageController extends Controller[m
                 }[m
 [m
                 // Flag the riddle as answered for this character[m
[31m-                $page->riddle->character()->attach($storySession['character_id'],[m
[32m+[m[32m                $page->riddle->characters()->attach($storySession['character_id'],[m
                     [[m
                         'riddle_id' => $page->riddle->id,[m
                     ]);[m
[36m@@ -203,7 +203,7 @@[m [mclass PageController extends Controller[m
                 'success'          => $answerIsCorrect,[m
                 'itemResponse'     => $itemResponse,[m
                 'pageResponse'     => $pageResponse,[m
[31m-                'solved'           => $page->riddle ? $page->riddle->isSolved() : 'bouh',[m
[32m+[m[32m                'solved'           => $page->riddle ? $page->riddle->isSolved($character) : 'bouh',[m
                 'refreshInventory' => $page->riddle && $page->riddle->item_id,[m
             ]);[m
         }[m
[1mdiff --git a/app/Models/Riddle.php b/app/Models/Riddle.php[m
[1mindex 1c8b41c..65e976c 100644[m
[1m--- a/app/Models/Riddle.php[m
[1m+++ b/app/Models/Riddle.php[m
[36m@@ -24,23 +24,24 @@[m [mclass Riddle extends Model[m
         return $this->belongsTo(Item::class);[m
     }[m
 [m
[31m-    public function character()[m
[32m+[m[32m    public function characters()[m
     {[m
         return $this->belongsToMany(Character::class);[m
     }[m
 [m
[31m-    public function isSolved()[m
[32m+[m[32m    public function prerequisites()[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->morphMany(Prerequisite::class, 'prerequisiteable');[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m
[32m+[m[32m    public function isSolved(Character $character)[m
     {[m
         if ($this->isRiddleSolved === null) {[m
[31m-            $this->isRiddleSolved = $this->character()->count() > 0;[m
[32m+[m[32m            $this->isRiddleSolved = $this->characters()->where('character_id', $character->id)->count() > 0;[m
         }[m
 [m
         return $this->isRiddleSolved;[m
     }[m
 [m
[31m-    public function prerequisites()[m
[31m-    {[m
[31m-        return $this->morphMany(Prerequisite::class, 'prerequisiteable');[m
[31m-    }[m
[31m-[m
 }[m
[1mdiff --git a/resources/views/story/partials/choices.blade.php b/resources/views/story/partials/choices.blade.php[m
[1mindex deafbc7..2b7d6eb 100644[m
[1m--- a/resources/views/story/partials/choices.blade.php[m
[1m+++ b/resources/views/story/partials/choices.blade.php[m
[36m@@ -1,5 +1,5 @@[m
 <div class="btn-toolbar choices-block" role="toolbar">[m
[31m-    @if ($page->riddle && $page->riddle->isSolved())[m
[32m+[m[32m    @if ($page->riddle && $page->riddle->isSolved($character))[m
         @if ($page->riddle->target_page_id)[m
             <a data-href="{{ route('story.play', ['story' => $page->story->id, 'page' => $page->riddle->target_page_id]) }}">[m
                 <button class="large button">{!! $page->riddle->target_page_text !!}</button>[m
[1mdiff --git a/resources/views/story/partials/riddle.blade.php b/resources/views/story/partials/riddle.blade.php[m
[1mindex da030e7..4216467 100644[m
[1m--- a/resources/views/story/partials/riddle.blade.php[m
[1m+++ b/resources/views/story/partials/riddle.blade.php[m
[36m@@ -10,7 +10,7 @@[m
             </h5>[m
             <div class="card-body">[m
                 <p class="card-text riddle-block"></p>[m
[31m-                    @if ($page->riddle->isSolved())[m
[32m+[m[32m                    @if ($page->riddle->isSolved($character))[m
                         @lang('page.riddle_already_solved')[m
                     @else[m
                         <div class="riddle_text">[m
